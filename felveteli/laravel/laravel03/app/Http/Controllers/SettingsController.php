<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function showGeneral() {
        $details = DB::table("user_details")->where("user", Auth::id())->first();

        return view("settings/general", [
            "details" => $details
        ]);
    }

    public function saveGeneral(Request $request) {
        DB::transaction(function () use ($request) {
            DB::table("user_details")->where("user", Auth::id())->update([
                "motto" => $request->input("motto", NULL),
                "about" => $request->input("about", NULL),
                "looking_for" => $request->input("looking_for", NULL),
                "wealth" => $request->input("wealth", NULL),
                "lifestyle" => $request->input("lifestyle", NULL),
                "yearly_income" => $request->input("yearly_income", NULL),
            ]);
        });

        return back();
    }

    public function showPassword() {
        $details = DB::table("user_details")->where("user", Auth::id())->first();

        return view("settings/password", [
            "details" => $details
        ]);
    }

    public function savePassword(Request $request) {
        if ($request->filled(["actual", "password", "confirm"]) == false) { return back(); }
        if (Hash::check($request->input("actual"), Auth::user()->password) == false) { return back(); }
        if ($request->input("password") != $request->input("confirm")) { return back(); }

        DB::transaction(function () use ($request) {
            DB::table("users")->where("id", Auth::id())->update([
                "password" => Hash::make($request->input("password"))
            ]);
        });

        return back();
    }

}
