<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VisitorController extends Controller
{

	public function showVisitors() {
        $visitors = DB::table("visitors as v")->select("v.*", "u.avatar", "u.name", "u.id", "u.city", "u.gender", "u.birthday")->leftJoin("users as u", "v.to", "=", "u.id")->where("v.from", Auth::id())->orderBy("v.created_at", "DESC")->get();

        DB::transaction(function () {
            DB::table("visitors")->where("from", Auth::id())->update([
                "unread" => 0
            ]);
        });

		return view("visitors/show", ["visitors" => $visitors]);
    }

}
