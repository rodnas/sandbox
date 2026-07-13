<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IndexController extends Controller
{

	public function showIndex(Request $request) {
		$order = $request->input("order", "newest");
		$users = DB::table("users")->where("active", 1)
		->when(($order == "newest"), function ($query) {
			$query->orderBy("created_at", "DESC");
		})
		->when(($order == "active"), function ($query) {
			$query->orderBy("updated_at", "DESC");
		})
		->when(($order == "youngest"), function ($query) {
			$query->orderBy("birthday", "DESC");
		})
		->paginate(10);

		return view("index/index", ["users" => $users, "order" => $order]);
	}

	public function showSearch() {
		$users = DB::table("users as u")->leftJoin("user_details as ud", "ud.user", "=", "u.id")->where("u.id", "!=", Auth::id())->orderBy("u.created_at", "DESC")->limit(20)->get();

		return view("index/search", ["users" => $users]);
	}

}
