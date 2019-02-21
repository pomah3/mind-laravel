<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User, Role};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller {
    public function get_default() {
        if (Auth::user()->has_role("classruk"))
            return $this->get(Auth::user()->get_role_arg("classruk"));

        if (Auth::user()->has_role("student"))
            return $this->get(Auth::user()->get_role_arg("student"));

        abort(403);
    }

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
            ->get()
            ->map(function($a) {return $a->role_arg;})
            ->sort(\App\Utils::get_group_cmp());

        foreach ($groups as $group) {
            $users = collect(User::of_group($group))->sort(\App\Utils::get_student_cmp());
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

        $pars = $groups
              ->map(function($a) {
                  return explode('-', $a)[0];
              })
              ->unique()->values();

        return view("group.all", [
            "groups" => $groups_ret,
            "pars" => $pars
        ]);
    }
}
