<?php

namespace App\Http\Controllers;

use App\Mail\VerifyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function index() {
        return view("settings");
    }

    public function change_password(Request $request) {
        $data = $request->validate([
            "new_password" => "required|confirmed",
            "old_password" => "required"
        ]);

        if (Auth::user()->password != $data["old_password"])
            return view("settings", ["status" => "wrong_password"]);

        $user = Auth::user();
        $user->password = $data["new_password"];
        $user->save();

        return redirect("/settings")->with("status", "ok");
    }

    public function change_email(Request $request) {
        $data = $request->validate([
            "email" => "required|email"
        ]);

        $user = Auth::user();

        $user->email = $data["email"];
        $user->email_verified_at = null;
        $user->save();

        Mail::to($user)->send(
            new VerifyMail($user)
        );

        return redirect("/settings")->with("status", "ok");
    }
}
