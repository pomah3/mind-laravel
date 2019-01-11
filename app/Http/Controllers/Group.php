<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User};

class Group extends Controller {
    public function get($group) {
        $users = User::where("group", $group)->get();
        $col = 0;
        foreach($users as $user) {
            $col += $user->student()->get_balance();
        }
        return view("group", [
            "group" => $group,
            "users" => $users,
            "balance" => $col
        ]);
    }    
}
