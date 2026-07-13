<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::pattern("id", "[0-9]{1,10}");
Route::pattern("message", "[a-zA-Z0-9]{15}");

Route::group(["middleware" => "guest"], function () {

	Route::get("/login", function () {
		return view("auth/info");
	})->name("login");

	Route::get("/showlogin", function () {
		return view("auth/login");
	});

	Route::post("/login", "AuthController@login");

	Route::get("/prereg", "PreregController@showPrereg");
	Route::post("/prereg", "PreregController@savePrereg");

	Route::get("/registration", "AuthController@showRegistrationStepOne");
	Route::post("/registration", "AuthController@saveRegistrationStepOne");

	Route::post("/webhooks/paypal", "PaymentController@processPayPalWebhook");
	Route::post("/webhooks/simple", "PaymentController@processSimpleWebhook");

});

// AUTH

Route::group(["middleware" => ["auth", "active"]], function () {

	Route::get("/", "IndexController@showIndex");
	Route::get("/search", "IndexController@showSearch");
	Route::post("/search", "IndexController@executeSearch");

	Route::get("/registration/picture", "AuthController@showRegistrationStepTwo");
	Route::post("/registration/picture", "AuthController@saveRegistrationStepTwo");
	Route::get("/registration/email", "AuthController@showRegistrationStepThree");

	Route::get("/favorites", "FavoriteController@showFavorites");
	Route::get("/favorites/{id}/add", "FavoriteController@addFavorite");
	Route::get("/favorites/{id}/remove", "FavoriteController@removeFavorite");

	Route::get("/messages", "MessageController@showMessages");
	Route::get("/messages/{message}", "MessageController@showMessage");
	Route::post("/messages/{message}", "MessageController@saveMessage");
	Route::get("/messages/{message}/delete", "MessageController@deleteMessage");
	Route::post("/messages/new", "MessageController@saveNewMessage");
	Route::get("/messages/new/{id}", "MessageController@newMessageToUser");

	Route::get("/requests", "RequestController@showRequests");
	Route::get("/requests/private/{id}/accept", "RequestController@acceptPrivateRequest");
	Route::get("/requests/private/{id}/remove", "RequestController@removePrivateRequest");

	Route::get("/platinum", "PlatinumController@showPlatinum");
	Route::get("/platinum/buy", "PlatinumController@showBuyPlatinum");

	Route::get("/profile", "ProfileController@showProfile");
	Route::get("/profile/{id}", "ProfileController@showProfileForUser");
	Route::get("/profile/galleries", "ProfileController@showGalleries");
	Route::get("/profile/{id}/galleries", "ProfileController@showGalleriesForUser");
	Route::get("/profile/{id}/galleries/private", "ProfileController@processPrivateGalleryRequest");
	Route::get("/profile/{id}/galleries/exclusive", "ProfileController@processExclusiveGalleryRequest");
	Route::post("/profile/galleries/price", "ProfileController@saveExclusiveGalleryPrice");
	Route::post("/profile/galleries/open", "ProfileController@uploadToOpenGallery");
	Route::post("/profile/galleries/private", "ProfileController@uploadToPrivateGallery");
	Route::post("/profile/galleries/exclusive", "ProfileController@uploadToExclusiveGallery");

	Route::get("/payments", "PaymentController@showPayments");
	Route::get("/payments/type/{type}", "PaymentController@getPaymentTypePrice");
	Route::post("/payments/fail", "PaymentController@failPaymentWithID");
	Route::post("/payments/cancel", "PaymentController@cancelPaymentWithID");
	Route::get("/payments/simple", "PaymentController@processSimplePayment");
	Route::post("/payments/create/paypal/{type}", "PaymentController@getPayPalPaymentForType");
	Route::post("/payments/create/simple/{type}", "PaymentController@getSimplePaymentForType");

	Route::get("/visitors", "VisitorController@showVisitors");

	Route::get("/settings", "SettingsController@showGeneral");
	Route::post("/settings", "SettingsController@saveGeneral");
	Route::get("/settings/password", "SettingsController@showPassword");
	Route::post("/settings/password", "SettingsController@savePassword");

	Route::get("/logout", function () {
		Auth::logout();
		return redirect("/login");
	});

});
