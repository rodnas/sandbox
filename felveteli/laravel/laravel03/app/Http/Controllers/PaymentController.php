<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use App\Simple\SimpleTransaction;
use App\Simple\SimpleLiveUpdate;
use App\Simple\SimpleBackRef;
use App\Simple\SimpleIos;
use App\Simple\SimpleIpn;
use App\Simple\SimpleIdn;
use App\Simple\SimpleIrn;

class PaymentController extends Controller
{

    public function __construct() {
        parent::__construct();

        $paypal_conf = \Config::get("paypal");

        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf["client_id"],
            $paypal_conf["secret"])
        );
        $this->_api_context->setConfig($paypal_conf["settings"]);
    }

    // GET: tranzakciók oldal
    public function showPayments() {
        $payments = DB::table("payments as p")->select("p.id", "pt.name", "pt.price", "p.status", "p.created_at")->leftJoin("payment_types as pt", "p.type", "=", "pt.id")->where("p.user", Auth::id())->orderBy("p.created_at", "desc")->get();

        return view("settings/payments", ["payments" => $payments]);
    }

    // GET: ár lekérése fizetés kategóriához
    public function getPaymentTypePrice($type) {
        $type = DB::table("payment_types")->where("id", $type)->first();
        if ($type == NULL) { return response("", 404); }

        return response()->json(["price" => $type->price]);
    }

    // GET: paypal fizetési azonosító kérése kategória alapján
    public function getPayPalPaymentForType(Request $request, $type) {
        $type = DB::table("payment_types")->where("id", $type)->first();
        if ($type == NULL) { return response("", 404); }

        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item = new Item();
        $item
        ->setName($type->name)
        ->setCurrency("HUF")
        ->setQuantity(1)
        ->setSku($type->id)
        ->setPrice($type->price);

        $item_list = new ItemList();
        $item_list->setItems([$item]);

        $amount = new Amount();
        $amount
        ->setCurrency("HUF")
        ->setTotal($type->price);

        $transaction = new Transaction();
        $transaction
        ->setAmount($amount)
        ->setItemList($item_list)
        ->setDescription($type->name);

        $redirect_urls = new RedirectUrls();
        $redirect_urls
        ->setReturnUrl(url(""))
        ->setCancelUrl(url(""));

        $payment = new Payment();
        $payment
        ->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirect_urls)
        ->setTransactions([$transaction]);

        $payment->create($this->_api_context);

        DB::transaction(function () use ($payment, $type) {
            DB::table("payments")->insert([
                "id" => str_random(20),
                "type" => $type->id,
                "user" => Auth::id(),
                "payment_id" => $payment->getId()
            ]);
        });

        return response()->json(["paymentID" => $payment->getId()]);
    }

    // GET: paypal fizetési azonosító kérése kategória alapján
    public function getSimplePaymentForType(Request $request, $type) {
        $type = DB::table("payment_types")->where("id", $type)->first();
        if ($type == NULL) { return response("", 404); }

        $transaction = str_random(20);
        $simple_config = \Config::get("simple");

        $lu = new SimpleLiveUpdate($simple_config, "HUF");
        $lu->setField("ORDER_REF", $transaction);

        $lu->addProduct([
            "name" => $type->name,
            "code" => $type->id,
            "info" => $type->name,
            "price" => $type->price,
            "vat" => 0,
            "qty" => 1
        ]);

        //Billing data
        $lu->setField("BILL_FNAME", "Tester");
        $lu->setField("BILL_LNAME", "SimplePay");
        $lu->setField("BILL_EMAIL", "sdk_test@otpmobil.com");
        $lu->setField("BILL_PHONE", "36201234567");
        $lu->setField("BILL_COUNTRYCODE", "HU");
        $lu->setField("BILL_STATE", "State");
        $lu->setField("BILL_CITY", "City");
        $lu->setField("BILL_ADDRESS", 'First line address');
        $lu->setField("BILL_ZIPCODE", "1234");

        //Delivery data
        $lu->setField("DELIVERY_FNAME", "Tester");
        $lu->setField("DELIVERY_LNAME", "SimplePay");
        $lu->setField("DELIVERY_PHONE", "36201234567");
        $lu->setField("DELIVERY_COUNTRYCODE", "HU");
        $lu->setField("DELIVERY_STATE", "State");
        $lu->setField("DELIVERY_CITY", "City");
        $lu->setField("DELIVERY_ADDRESS", "First line address");
        $lu->setField("DELIVERY_ZIPCODE", "1234");

        DB::transaction(function () use ($transaction, $type) {
            DB::table("payments")->insert([
                "id" => $transaction,
                "type" => $type->id,
                "user" => Auth::id()
            ]);
        });

        $display = $lu->createHtmlForm("SimplePay", "button", "SimplePay fizetés indítása");
        return $display;
    }

    // GET: Simple redirect feldolgozása
    public function processSimplePayment(Request $request) {
        $simple_config = \Config::get("simple");
        $backref = new SimpleBackRef($simple_config, "HUF");

        $transaction = $request->input("order_ref");
        $backref->order_ref = $transaction;

        if ($backref->checkResponse() == false) {
            DB::transaction(function () use ($transaction) {
                DB::table("payments")->where("id", $transaction)->update([
                    "status" => "D"
                ]);
            });
        }

        return redirect("/payments");
    }

    // POST: fizetési tranzakció elutasítása
    public function failPaymentWithID(Request $request) {
        $paymentID = $request->input("paymentID");
        $payment = DB::table("payments")->where("payment_id", $paymentID)->first();
        if ($payment == NULL) { return response("", 404); }

        DB::transaction(function () use ($payment) {
            DB::table("payments")->where("id", $payment->id)->update([
                "status" => "F"
            ]);
        });

        return response("", 200);
    }

    // POST: fizetési tranzakció visszavonása
    public function cancelPaymentWithID(Request $request) {
        $paymentID = $request->input("paymentID");
        $payment = DB::table("payments")->where("payment_id", $paymentID)->first();
        if ($payment == NULL) { return response("", 404); }

        DB::transaction(function () use ($payment) {
            DB::table("payments")->where("id", $payment->id)->update([
                "status" => "C"
            ]);
        });

        return response("", 200);
    }

    // POST: PayPal webhook feldolgozása
    public function processPayPalWebhook(Request $request) {
        if ($request->header("paypal-transmission-id") == NULL) { return response("", 404); }
        $webhook = (object) $request->json()->all();
        $resource = (object) $webhook->resource;

        if ($webhook->event_type == "PAYMENT.SALE.DENIED") {
            DB::transaction(function () use ($resource) {
                DB::table("payments")->where("payment_id", $resource->parent_payment)->update([
                    "status" => "D"
                ]);
            });

            return response()->json();
        }

        if ($webhook->event_type == "PAYMENT.SALE.COMPLETED") {
            DB::transaction(function () use ($resource) {
                DB::table("payments")->where("payment_id", $resource->parent_payment)->update([
                    "status" => "S"
                ]);
            });

            return response()->json();
        }

        return response("", 500);
    }

    // POST: OTP Simple webhook feldolgozása
    public function processSimpleWebhook(Request $request) {
        $simple_config = \Config::get("simple");
        $ipn = new SimpleIpn($simple_config, "HUF");

        Log::debug(var_dump($ipn));

        if ($ipn->validateReceived() == false) { return; }
        $ipn->confirmReceived();

        return response()->json();
    }

}
