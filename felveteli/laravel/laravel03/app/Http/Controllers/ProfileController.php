<?php

namespace App\Http\Controllers;

use Image;
use App\Http\ImageFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

	public function showProfile() {
		$galleries = $this->getGalleriesForUser(Auth::id(), 6);
		$details = DB::table("user_details")->where("user", Auth::id())->first();

		return view("profile/own/profile", [
			"details" => $details,
			"gal_open" => $galleries["gal_open"],
			"gal_private" => $galleries["gal_private"],
			"gal_exclusive" => $galleries["gal_exclusive"]
		]);
	}

	public function showProfileForUser($user) {
		if ($user == Auth::id()) { return redirect("/profile"); }

		$user = DB::table("users")->where("id", $user)->first();
		if ($user == NULL) { return redirect("/"); }

		$visit = DB::table("visitors")->where("from", $user->id)->where("to", Auth::id())->first();
		if ($visit == NULL) {
			DB::transaction(function () use ($user) {
				DB::table("visitors")->insert([
					"from" => $user->id,
					"to" => Auth::id()
				]);

				DB::table("notifications")->insert([
					"user" => $user->id,
					"from" => Auth::id(),
					"notification" => "meglátogatta az adatlapodat"
				]);
			});
		}
		else {
			DB::transaction(function () use ($user) {
				DB::table("visitors")->where("from", $user->id)->where("to", Auth::id())->update([
					"created_at" => date("Y-m-d H:i:s")
				]);
			});
		}

		$galleries = $this->getGalleriesForUser($user->id, 6);
		$details = DB::table("user_details")->where("user", $user->id)->first();
		$permission_private = DB::table("permission_private")->select("active")->where("from", Auth::id())->where("to", $user->id)->first();
		$permission_exclusive = DB::table("permission_exclusive")->select("active")->where("from", Auth::id())->where("to", $user->id)->first();

		return view("profile/profile", [
			"user" => $user,
			"details" => $details,
			"gal_open" => $galleries["gal_open"],
			"gal_private" => $galleries["gal_private"],
			"gal_exclusive" => $galleries["gal_exclusive"],
			"permission_private" => $permission_private,
			"permission_exclusive" => $permission_exclusive
		]);
	}

	public function showGalleries() {
		$galleries = $this->getGalleriesForUser(Auth::id());
		$details = DB::table("user_details")->where("user", Auth::id())->first();
		$requests = DB::table("permission_private as pp")->select("avatar", "from", "name", "pp.active")->leftJoin("users as u", "pp.from", "=", "u.id")->where("pp.to", Auth::id())->orderBy("pp.created_at", "desc")->limit(10)->get();

		return view("profile/own/galleries", [
			"details" => $details,
			"requests" => $requests,
			"gal_open" => $galleries["gal_open"],
			"gal_private" => $galleries["gal_private"],
			"gal_exclusive" => $galleries["gal_exclusive"]
		]);
	}

	public function showGalleriesForUser($user) {
		$user = DB::table("users")->where("id", $user)->first();
		if ($user == NULL) { return redirect("/"); }

		$galleries = $this->getGalleriesForUser($user->id);
		$details = DB::table("user_details")->where("user", $user->id)->first();
		$permission_private = DB::table("permission_private")->select("active")->where("from", Auth::id())->where("to", $user->id)->first();
		$permission_exclusive = DB::table("permission_exclusive")->select("active")->where("from", Auth::id())->where("to", $user->id)->first();

		return view("profile/galleries", [
			"user" => $user,
			"details" => $details,
			"gal_open" => $galleries["gal_open"],
			"gal_private" => $galleries["gal_private"],
			"gal_exclusive" => $galleries["gal_exclusive"],
			"permission_private" => $permission_private,
			"permission_exclusive" => $permission_exclusive
		]);
	}

	public function uploadToOpenGallery(Request $request) {
		$photos = $request->file("picture");

		if (!is_array($photos)) {
			$photos = [$photos];
		}

		for ($i = 0; $i < count($photos); $i++) {
			$photo = $photos[$i];
			$filename = str_random(50) . "." . $photo->getClientOriginalExtension();
			$photo->storeAs(App::environment() . "/original", $filename);

			DB::transaction(function () use ($filename) {
				DB::table("gallery_open")->insert([
					"user" => Auth::id(),
					"image" => $filename
				]);
			});

			$width = 1500;
			$height = 1500;

			$image = Image::make($photo);
			$image->width() > $image->height() ? $height = null : $width = null;
			$image->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			$large = new ImageFile($image->save($photo->path(), 90));
			Storage::putFileAs(App::environment() . "/large", $large, $filename, "public");

			$small = new ImageFile(Image::make($photo)->fit(600)->save($photo->path(), 60));
			Storage::putFileAs(App::environment() . "/small", $small, $filename, "public");

			unlink($photo->path());
		}

		return response()->json([
			"message" => "A feltöltés sikeres!"
		], 200);
	}

	public function uploadToPrivateGallery(Request $request) {
		$photos = $request->file("picture");

		if (!is_array($photos)) {
			$photos = [$photos];
		}

		for ($i = 0; $i < count($photos); $i++) {
			$photo = $photos[$i];
			$fn_small = str_random(50) . "." . $photo->getClientOriginalExtension();
			$fn_original = str_random(50) . "." . $photo->getClientOriginalExtension();
			$fn_pixelated = str_random(50) . "." . $photo->getClientOriginalExtension();
			$photo->storeAs(App::environment() . "/original", $fn_original);

			DB::transaction(function () use ($fn_small, $fn_original, $fn_pixelated) {
				DB::table("gallery_private")->insert([
					"user" => Auth::id(),
					"small" => $fn_small,
					"original" => $fn_original,
					"pixelated" => $fn_pixelated
				]);
			});

			$width = 1500;
			$height = 1500;

			$image = Image::make($photo);
			$image->width() > $image->height() ? $height = null : $width = null;
			$image->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			$large = new ImageFile($image->save($photo->path(), 90));
			Storage::putFileAs(App::environment() . "/large", $large, $fn_original, "public");

			$small = new ImageFile(Image::make($photo)->fit(600)->save($photo->path() . "s", 60));
			Storage::putFileAs(App::environment() . "/small", $small, $fn_small, "public");

			$pixelated = new ImageFile(Image::make($photo)->fit(600)->pixelate(15)->save($photo->path() . "p", 60));
			Storage::putFileAs(App::environment() . "/small", $pixelated, $fn_pixelated, "public");

			unlink($photo->path()."s");
			unlink($photo->path()."p");
			unlink($photo->path());
		}

		return response()->json([
			"message" => "A feltöltés sikeres!"
		], 200);
	}

	public function uploadToExclusiveGallery(Request $request) {
		$photos = $request->file("picture");

		if (!is_array($photos)) {
			$photos = [$photos];
		}

		for ($i = 0; $i < count($photos); $i++) {
			$photo = $photos[$i];
			$fn_small = str_random(50) . "." . $photo->getClientOriginalExtension();
			$fn_original = str_random(50) . "." . $photo->getClientOriginalExtension();
			$fn_pixelated = str_random(50) . "." . $photo->getClientOriginalExtension();
			$photo->storeAs(App::environment() . "/original", $fn_original);

			DB::transaction(function () use ($fn_small, $fn_original, $fn_pixelated) {
				DB::table("gallery_exclusive")->insert([
					"user" => Auth::id(),
					"small" => $fn_small,
					"original" => $fn_original,
					"pixelated" => $fn_pixelated
				]);
			});

			$width = 1500;
			$height = 1500;

			$image = Image::make($photo);
			$image->width() > $image->height() ? $height = null : $width = null;
			$image->resize($width, $height, function ($constraint) {
				$constraint->aspectRatio();
				$constraint->upsize();
			});

			$large = new ImageFile($image->save($photo->path(), 90));
			Storage::putFileAs(App::environment() . "/large", $large, $fn_original, "public");

			$small = new ImageFile(Image::make($photo)->fit(600)->save($photo->path() . "s", 60));
			Storage::putFileAs(App::environment() . "/small", $small, $fn_small, "public");

			$pixelated = new ImageFile(Image::make($photo)->fit(600)->pixelate(15)->save($photo->path() . "p", 60));
			Storage::putFileAs(App::environment() . "/small", $pixelated, $fn_pixelated, "public");

			unlink($photo->path()."s");
			unlink($photo->path()."p");
			unlink($photo->path());
		}

		return response()->json([
			"message" => "A feltöltés sikeres!",
			"path" => $photos[0]->path()
		], 200);
	}

	public function processPrivateGalleryRequest($user) {
		$user = DB::table("users")->where("id", $user)->first();
		if ($user == NULL) { return redirect("/"); }

		$request = DB::table("permission_private")->where("from", Auth::id())->where("to", $user->id)->first();
		if ($request) { return redirect("/profile/" . $user->id . "/galleries"); }

		DB::transaction(function () use ($user) {
			DB::table("permission_private")->insert([
				"from" => Auth::id(),
				"to" => $user->id
			]);
		});

		return redirect("/profile/" . $user->id . "/galleries");
	}

	public function processExclusiveGalleryRequest($user) {
		$user = DB::table("users")->where("id", $user)->first();
		if ($user == NULL) { return redirect("/"); }

		$request = DB::table("permission_exclusive")->where("from", Auth::id())->where("to", $user->id)->first();
		if ($request) { return redirect("/profile/" . $user->id . "/galleries"); }
		if (Auth::user()->credits < $user->exclusive) { return redirect("/profile/" . $user->id . "/galleries"); }

		DB::transaction(function () use ($user) {
			DB::table("permission_exclusive")->insert([
				"from" => Auth::id(),
				"to" => $user->id
			]);

			DB::table("users")->where("id", Auth::id())->update([
				"credits" => (Auth::user()->credits - $user->exclusive)
			]);

			DB::table("users")->where("id", $user->id)->update([
				"credits" => ($user->credits + ($user->exclusive * 0.9))
			]);
		});

		return redirect("/profile/" . $user->id . "/galleries");
	}

	public function saveExclusiveGalleryPrice(Request $request) {
		$price = $request->exclusive;

		if ($price >= 100 && $price <= 1000) {
			DB::transaction(function () use ($price) {
				DB::table("users")->where("id", Auth::id())->update([
					"exclusive" => $price
				]);
			});
		}

		return back();
	}

	// --

	private function getGalleriesForUser($userid, $limit = 1000) {
		$gal_open = DB::table("gallery_open")->where("user", $userid)->orderBy("created_at", "desc")->limit($limit)->get();
		$gal_private = DB::table("gallery_private")->where("user", $userid)->orderBy("created_at", "desc")->limit($limit)->get();
		$gal_exclusive = DB::table("gallery_exclusive")->where("user", $userid)->orderBy("created_at", "desc")->limit($limit)->get();

		return [
			"gal_open" => $gal_open,
			"gal_private" => $gal_private,
			"gal_exclusive" => $gal_exclusive
		];
	}

}
