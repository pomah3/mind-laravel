<?php

namespace App\Http\Controllers;

use App\EduTatar\EduTatarAuth;
use App\User;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SigninController extends Controller {
    use ThrottlesLogins;

    private $eta;

    public function __construct(EduTatarAuth $eta) {
        $this->eta = $eta;
    }

    public function index() {
        return view("signin");
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('signin');
    }


    public function enter(Request $request) {
        extract($request->validate([
            "login" => "required",
            "password" => "required"
        ]));

        $this->incrementLoginAttempts($request);

        if ($this->hasTooManyLoginAttempts($request))
            return redirect()->back()
                             ->withErrors(trans("signin.toomany"))
                             ->withInput();

        $user = null;
        $user = $user ?? $this->enter_base($login, $password);
        $user = $user ?? $this->enter_email($login, $password);
        $user = $user ?? $this->enter_edu($login, $password);

        if ($user) {
            $this->clearLoginAttempts($request);

            Auth::login($user);

            $route = "profile";
            if ($user->last_visit == null)
                $route = "first_visit";

            $user->last_visit = now();
            $user->save();

            return redirect()->route($route);
        }

        return redirect()->back()
            ->withErrors(trans("signin.wrong"))
            ->withInput();
    }

    private function enter_base($login, $password) {
        $user = User::find($login);
        if (!$user || $password != $user->password)
            return null;

        return $user;
    }

    private function enter_email($login, $password) {
        $user = User::where("email", $login)->first();

        if (!$user || $password != $user->password)
            return null;

        return $user;
    }

    private function enter_edu($login, $password) {
        if (!config("app.edu_tatar_auth", false))
            return null;

        $user = $this->eta->get_user($login, $password);
        if ($user == null)
            return null;

        $user->edu_tatar_login = $login;
        $user->edu_tatar_password = $password;
        $user->save();

        return $user;
    }

    protected function username() {
        return "login";
    }
}
