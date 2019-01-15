<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SigninController extends Controller
{
    public function index() {
        return view("signin");
    }

    public function enter(Request $request) {
        $validator = Validator::make($request->all(), [
            "login" => "required|integer|min:1|exists:users,id",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return view("signin", ["status" => "wrong_password"]);
        }

        $login = $request->login;
        $password = $request->password;

        $user = User::find($login);

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
