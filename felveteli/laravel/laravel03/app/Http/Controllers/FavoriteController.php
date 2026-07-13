<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{

	public function showFavorites() {
        $favorites = DB::table("favorites as f")->leftJoin("users as u", "f.from", "=", "u.id")->where("f.to", Auth::id())->orderBy("f.created_at", "DESC")->get();
        $myfavorites = DB::table("favorites as f")->leftJoin("users as u", "f.to", "=", "u.id")->where("f.from", Auth::id())->orderBy("f.created_at", "DESC")->get();

		return view("favorites/my_favorites", ["favorites" => $favorites, "myfavorites" => $myfavorites]);
    }

    public function addFavorite($user) {
        $favorite = DB::table("favorites")->where("from", Auth::id())->where("to", $user)->first();
        if ($favorite) { return back(); }

        DB::transaction(function () use ($user) {
			DB::table("favorites")->insert([
                "from" => Auth::id(),
                "to" => $user
            ]);

            DB::table("notifications")->insert([
                "user" => $user,
                "from" => Auth::id(),
                "notification" => "kedvencnek jelölt"
            ]);
		});

        return back();
    }

    public function removeFavorite($user) {
        $favorite = DB::table("favorites")->where("from", Auth::id())->where("to", $user)->first();
        if ($favorite == NULL) { return back(); }

        DB::transaction(function () use ($user) {
            DB::table("favorites")->where("from", Auth::id())->where("to", $user)->delete();

            DB::table("notifications")->insert([
                "user" => $user,
                "from" => Auth::id(),
                "notification" => "törölt a kedvencei közül"
            ]);
		});

        return back();
    }

}
