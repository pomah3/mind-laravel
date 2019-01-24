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
        $data = $request->validate([
            "login" => "required",
            "password" => "required"
        ]);

        $user = User::find($data["login"]);

        if (!$user || $data["password"] !== $user->password)
            return redirect()->back()
                             ->withErrors(trans("signin.wrong"))
                             ->withInput();

        Auth::login($user);

        return redirect()->route("profile");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('signin');
    }
}
