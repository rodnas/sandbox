<?php

namespace App\Http\Controllers;

use Image;
use Validator;
use App\Http\ImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PreregController extends Controller
{

	public function showPrereg() {
		return view("prereg/new");
	}

	// POST: elő regisztrációs adatok
	public function savePrereg(Request $request) {
		$validator = Validator::make($request->all(), [
			"accepted" => "accepted",
			"name" => "required|max:255",
			'identifier'  => 'required|string|max:100|unique:prereg,identifier',
		]);

		if ($validator->fails()) {
			return redirect("/prereg")->withErrors($validator)->withInput();
		}

		DB::transaction(function () use ($request) {
			DB::table("prereg")->insert([
				"name" => $request->input("name"),
				"identifier" => $request->input("identifier"),
				"accepted" => 1,
				"created_at" => date("Y-m-d H:i:s"),
				"remember_token" => $request->input("_token")
			]);
		});

		return view("/prereg/new")->withSuccess('Elő regisztráció sikeres!');;
	}

}
