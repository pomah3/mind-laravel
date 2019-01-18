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
        $request->validate([
            "login" => "required|integer|min:1|exists:users,id",
            "password" => "required"
        ]);

        $login = $request->login;
        $password = $request->password;

        $user = User::find($login);

        if ($user->password !== $password)
            return view("signin");

        Auth::login($user);

        return redirect()->route("profile");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('signin');
    }
}
