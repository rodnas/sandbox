<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    // GET: üres csevegések lap, ha nincs üzenet; különben átirányítás a legfrissebbre
    public function showMessages() {
        $mapper = function($m) {
            return $m->group;
        };

        $messageids = DB::table("message_users")->where("user", Auth::id())->where("active", 1)->get();
        $recipients = DB::table("message_users as mu")->select("mu.group", "mu.user", "u.name", "u.avatar", DB::raw("MAX(m.created_at) as last_timestamp"))->leftJoin("users as u", "mu.user", "=", "u.id")->leftJoin("messages as m", "mu.group", "=", "m.group")->whereIn("mu.group", array_map($mapper, iterator_to_array($messageids)))->where("mu.user", "!=", Auth::id())->groupBy("mu.group", "mu.user", "u.name", "u.avatar")->orderBy("last_timestamp", "desc")->first();

        if ($recipients) {
            return redirect("/messages/" . $recipients->group);
        }

        return view("messages/messages", ["recipients" => $recipients]);
    }

    // GET: csevegés megnyitása azonosítóval
    public function showMessage($message) {
        $mapper = function($m) {
            return $m->group;
        };

        $messageids = DB::table("message_users")->where("user", Auth::id())->where("active", 1)->get();
        $recipients = DB::table("message_users as mu")->select("mu.group", "mu.user", "u.name", "u.avatar", DB::raw("MAX(m.created_at) as last_timestamp"))->leftJoin("users as u", "mu.user", "=", "u.id")->leftJoin("messages as m", "mu.group", "=", "m.group")->whereIn("mu.group", array_map($mapper, iterator_to_array($messageids)))->where("mu.user", "!=", Auth::id())->groupBy("mu.group", "mu.user", "u.name", "u.avatar")->orderBy("last_timestamp", "desc")->get();
        $messages = DB::table("messages as m")->select("m.user", "m.message", "m.created_at", "u.avatar")->leftJoin("users as u", "m.user", "=", "u.id")->where("m.group", $message)->orderBy("m.created_at", "asc")->get();

        if (count($messages) == 0) { return redirect("/"); }

        $recipient = DB::table("message_users as mu")->leftJoin("users as u", "mu.user", "=", "u.id")->where("mu.group", $message)->where("mu.user", "!=", Auth::id())->first();

        return view("messages/messages", ["recipients" => $recipients, "recipient" => $recipient, "messages" => $messages, "messageid" => $message]);
    }

    // POST: üzenet mentése a csevegéshez
    public function saveMessage(Request $request, $messageid) {
        $message = $request->input("message");

        DB::transaction(function () use ($message, $messageid) {
            DB::table("messages")->insert([
                "group" => $messageid,
                "user" => Auth::id(),
                "message" => $message
            ]);
        });

        return back();
    }

    // POST: csevegés elrejtés a felhasználó elől
    public function deleteMessage(Request $request, $messageid) {
        $group = DB::table("message_users")->where("group", $messageid)->where("user", Auth::id())->first();
        if ($group == NULL) { return back(); }

        DB::transaction(function () use ($group) {
            DB::table("message_users")->where("group", $group->group)->where("user", Auth::id())->update([
                "active" => 0
            ]);
        });

        return redirect("/messages");
    }

    // GET: új csevegés indítása oldal
    public function newMessageToUser($user) {
        $user = DB::table("users")->where("id", $user)->first();
        if ($user == NULL) { return back(); }

        return view("messages/new", ["user" => $user]);
    }

    // POST: új csevegés indítása
    public function saveNewMessage(Request $request) {
        $user = DB::table("users")->where("id", $request->input("user"))->first();
        if ($user == NULL) { return back(); }

        $message = $request->input("message");
        $messageid = str_random(15);

        DB::transaction(function () use ($user, $message, $messageid) {
            DB::table("message_groups")->insert([
                "id" => $messageid
            ]);

            DB::table("message_users")->insert([
                "group" => $messageid,
                "user" => $user->id
            ]);

            DB::table("message_users")->insert([
                "group" => $messageid,
                "user" => Auth::id()
            ]);

            DB::table("messages")->insert([
                "group" => $messageid,
                "user" => Auth::id(),
                "message" => $message
            ]);
        });

        return redirect("/messages");
    }

}
