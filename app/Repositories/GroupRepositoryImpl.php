<?php

namespace App\Repositories;
use App\User;
use App\Role;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class GroupRepositoryImpl implements GroupRepository {
    public function get_names() {
        return DB::table("roles")
            ->select('role_arg')
            ->where('role', 'student')
            ->groupBy('role_arg')
            ->orderBy('role_arg')
            ->get()
            ->map(function($a) {return $a->role_arg;})
            ->sort(\App\Utils::get_group_cmp());
    }

    public function get_pars() {
        return $this->get_names()
                    ->map(function($a) {
                        return \App\Utils::sep_group($a)[0];
                    })
                    ->unique()
                    ->values();
    }

    public function get_all() {
        $groups = [];

        foreach ($this->get_names() as $group)
            $groups[] = $this->get($group);

        return $groups;
    }

    public function get($group) {
        $roles = Role::where("role", "student")->where("role_arg", $group)->get();
        $users = [];
        foreach($roles as $role) {
            $users[] = User::find($role->user_id);
        }

        $users = collect($users)
                ->sort(\App\Utils::get_student_cmp());

        $balance = 0;
        foreach($users as $user) {
            $balance += $user->student()->get_balance();
        }

        return [
            "users" => $users,
            "group" => $group,
            "balance" => $balance
        ];
    }
}
