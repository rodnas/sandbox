<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PlatinumController extends Controller
{

	public function showPlatinum() {
        $platinums = DB::table("users")->select("*", DB::raw("DIAMONDS(diamonds) AS dia"))->where("diamonds", ">", 0)->orderBy("diamonds", "desc")->get();

        return view("platinum/show", ["platinums" => $platinums]);
    }

    public function showBuyPlatinum() {
        return view("platinum/buy");
    }

}
