<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{

    public function showRequests() {
        $pending = [];
        $accepted = [];
        $requests = DB::table("permission_private as pp")->select("id", "birthday", "gender", "city", "avatar", "from", "name", "pp.active")->leftJoin("users as u", "pp.from", "=", "u.id")->where("pp.to", Auth::id())->orderBy("pp.created_at", "desc")->get();

        foreach ($requests as $req) {
            switch ($req->active) {
                case 0:
                    $pending[] = $req;
                    break;
                case 1:
                    $accepted[] = $req;
                    break;
            }
        }

        $mypending = [];
        $myaccepted = [];
        $myrequests = DB::table("permission_private as pp")->select("id", "birthday", "gender", "city", "avatar", "from", "name", "pp.active")->leftJoin("users as u", "pp.to", "=", "u.id")->where("pp.from", Auth::id())->orderBy("pp.created_at", "desc")->get();

        foreach ($myrequests as $req) {
            switch ($req->active) {
                case 0:
                    $mypending[] = $req;
                    break;
                case 1:
                    $myaccepted[] = $req;
                    break;
            }
        }

		return view("requests/requests", ["pending" => $pending, "accepted" => $accepted, "mypending" => $mypending, "myaccepted" => $myaccepted]);
    }

    public function acceptPrivateRequest($user) {
        $user = DB::table("users")->where("id", $user)->first();
        if ($user == NULL) { return back(); }

        $request = DB::table("permission_private")->where("to", Auth::id())->where("from", $user->id)->first();
        if ($request == NULL) { return back(); }

        DB::transaction(function () use ($user) {
            DB::table("permission_private")->where("to", Auth::id())->where("from", $user->id)->update([
                "active" => 1
            ]);

            DB::table("notifications")->insert([
                "user" => $user->id,
                "from" => Auth::id(),
                "notification" => "elfogadta a privát galéria kérést"
            ]);
        });

        return back();
    }

    public function removePrivateRequest($user) {
        $user = DB::table("users")->where("id", $user)->first();
        if ($user == NULL) { return back(); }

        $request = DB::table("permission_private")->where("to", Auth::id())->where("from", $user->id)->first();
        if ($request == NULL) { return back(); }

        DB::transaction(function () use ($user) {
            DB::table("permission_private")->where("to", Auth::id())->where("from", $user->id)->delete();

            DB::table("notifications")->insert([
                "user" => $user->id,
                "from" => Auth::id(),
                "notification" => "törölte a privát galéria kérést"
            ]);
        });

        return back();
    }

}
