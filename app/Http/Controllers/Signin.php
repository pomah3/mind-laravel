<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Signin extends Controller
{
    public function index() {
        return view("signin");
    }

    public function enter(Request $request) {
        $login = intval($request->login);
        $password = $request->password;

        $user = User::find($login);

        if ($user === null)
            return view("signin", ["status" => "no_user", "login" => $login]);

        if ($user->password !== $password)
            return view("signin", ["status" => "wrong_password", "login" => $login]);

        Auth::login($user);

        return redirect()->route("profile");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('signin');
    }
}
