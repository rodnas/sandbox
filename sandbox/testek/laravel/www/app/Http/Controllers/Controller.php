<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct() {
		$this->middleware(function ($request, $next) {
			$unread_visitors = DB::table("visitors")->where("from", Auth::id())->where("unread", 1)->get();
			View::share("unread_visitors", $unread_visitors);

			$notifications = DB::table("notifications as n")->select("u.name", "u.avatar", "n.from", "n.notification", "n.created_at")->leftJoin("users as u", "n.from", "=", "u.id")->where("n.user", Auth::id())->where("n.unread", 1)->orderBy("n.created_at", "desc")->get();
			View::share("notifications", $notifications);

			$sideusers = DB::table("users")->select("id", "avatar")->orderBy(DB::raw("RAND()"))->limit(10)->get();
			View::share("sideusers", $sideusers);

			$diamonds = DB::table("users")->select("id", "name", DB::raw("DIAMONDS(diamonds) as diamonds"), "avatar")->where("diamonds", ">", 0)->orderBy("diamonds", "desc")->limit(3)->get();
			View::share("diamonds", $diamonds);

            return $next($request);
        });
	}

}
