<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User, Role};
use Illuminate\Support\Facades\DB;

class Group extends Controller {
    public function get($group) {
        $users = User::of_group($group);

        $col = 0;
        foreach($users as $user) {
            $col += $user->student()->get_balance();
        }
        return view("group.get", [
            "group" => $group,
            "users" => $users,
            "balance" => $col
        ]);
    }

    public function all() {
        $groups_ret = [];

        $groups = DB::table("roles")
            ->select('role_arg')
            ->where('role', 'student')
            ->groupBy('role_arg')
            ->orderBy('role_arg')
            ->get();

        foreach ($groups as $group) {
            $group = $group->role_arg;

            $users = User::of_group($group);
            $balance = 0;
            foreach($users as $user) {
                $balance += $user->student()->get_balance();
            }

            $groups_ret[] = [
                "balance" => $balance,
                "users" => $users,
                "group" => $group
            ];
        }

        return view("group.all", [
            "groups" => $groups_ret
        ]);
    }
}
