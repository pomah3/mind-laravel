<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function index() {
        $this->authorize("see-status-index");

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
            $users = collect(User::of_group($group))
                ->sort(\App\Utils::get_student_cmp())
                ->filter(function($u) {
                    return Auth::user()->can("see-status", $u) ||
                           Auth::user()->can("set-status", $u);
                })
                ->values();

            if (filled($users))
                $groups_ret[] = [
                    "users" => $users,
                    "group" => $group
                ];
        }

        $pars = $groups
              ->map(function($a) {
                  return explode('-', $a)[0];
              })
              ->unique()->values();

        return view("status.index", [
            "groups" => $groups_ret,
            "pars" => $pars
        ]);
    }

    public function set(User $user, string $status) {
        $this->authorize("set-status", $user);

        $user->status->title = $status;
        $user->status->save();
        return "";
    }
}
