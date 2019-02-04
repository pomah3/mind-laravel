<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function show(User $user) {
        return view("user.show", ["user"=>$user]);
    }

    public function index() {
        $this->authorize("view", User::class);
        return view("user.index", ["users" => User::all()]);
    }
}
