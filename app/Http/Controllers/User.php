<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class User extends Controller
{
    public function show(User $user) {
        return view("user.show", ["user"=>$user]);
    }
}
