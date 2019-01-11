<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Signin extends Controller
{
    public function index() {
        return view("signin", ["status" => "not_set"]);
    }

    public function enter(Request $request) {
        $login = intval($request->login);
        $password = $request->password;

        $user = User::find($login);

        if ($user === null)
            return view("signin", ["status" => "no_user"]);

        if ($user->password !== $password)
            return view("signin", ["status" => "$login $password ".$user->password]);

        Auth::login($user);

        return redirect()->route("profile");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('signin');
    }
}
