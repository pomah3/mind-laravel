<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User, Role};

class Group extends Controller {
    public function get($group) {
        $roles = Role::where("role", "student")->where("role_arg", $group)->get();
        $users = [];
        foreach($roles as $role) {
            $users[] = User::find($role->user_id);
        }

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
