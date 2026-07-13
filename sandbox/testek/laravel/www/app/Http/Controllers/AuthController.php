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

class AuthController extends Controller
{

	// POST: belépés
	public function login(Request $request) {
		if (Auth::attempt(["email" => $request->input("email"), "password" => $request->input("password"), "active" => 1])) {
			DB::transaction(function () use ($request) {
				DB::table("users")->where("email", $request->input("email"))->update([
					"updated_at" => date("Y-m-d H:i:s")
				]);
			});

			return redirect()->intended("/");
		}
		else {
			return redirect("/login")->with("error", true);
		}
	}

	// GET: regisztráció oldal
	public function showRegistrationStepOne() {
		if (Auth::check()) { return redirect("/"); }

		return view("auth/step_one");
	}

	// POST: regisztrációs alapadatok
	public function saveRegistrationStepOne(Request $request) {
		$validator = Validator::make($request->all(), [
			"agree" => "accepted",
			"type" => "required",
			"name" => "required|max:200",
			"email" => "required|email|max:200",
			"password" => "required|max:200",
			"year" => "required|numeric",
			"month" => "required|numeric",
			"day" => "required|numeric",
			"city" => "required",
			"gender" => "required",
		]);

		if ($validator->fails()) {
			return redirect("/registration")->withErrors($validator)->withInput();
		}

		DB::transaction(function () use ($request) {
			DB::table("users")->insert([
				"name" => $request->input("name"),
				"email" => $request->input("email"),
				"password" => Hash::make($request->input("password")),
				"birthday" => $request->input("year") . "-" . $request->input("month") . "-" . $request->input("day"),
				"city" => $request->input("city"),
				"gender" => $request->input("gender"),
				"type" => $request->input("type"),
				"created_at" => date("Y-m-d H:i:s")
			]);
		});

		$user = DB::table("users")->where("email", $request->input("email"))->first();
		Auth::loginUsingId($user->id);

		DB::transaction(function () use ($user) {
			DB::table("user_details")->insert([
				"user" => $user->id
			]);
		});

		return redirect("/registration/picture");
	}

	// GET: regisztráció profilkép feltöltés
	public function showRegistrationStepTwo() {
		if (Auth::user()->avatar) { return redirect("/"); }

		return view("auth/step_two");
	}

	// POST: regisztráció profilkép feltöltés
	public function saveRegistrationStepTwo(Request $request) {
		if ($request->picture->isValid()) {
			$filename = str_random(50) . "." . $request->picture->getClientOriginalExtension();
			$request->picture->storeAs(App::environment() . "/original", $filename);

			DB::transaction(function () use ($filename) {
				DB::table("users")->where("id", Auth::id())->update([
					"avatar" => $filename
				]);
			});

			$avatar = new ImageFile(Image::make($request->picture->path())->fit(600)->save($request->picture->path(), 60));
			Storage::putFileAs(App::environment() . "/avatar", $avatar, $filename, "public");

			unlink($request->picture->path());
			return redirect("/registration/email");
		}

		return redirect("/registration/picture")->with("error", true);
	}

	// GET: regisztráció, utolsó lap
	public function showRegistrationStepThree() {
		return view("auth/step_three");
	}

}
