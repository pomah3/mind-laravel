<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Transaction, User, Role};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Repositories\GroupRepository;

class GroupController extends Controller {
    private $groups;

    public function __construct(GroupRepository $groups) {
        $this->groups = $groups;
    }

    public function get_default() {
        $user = Auth::user();

        if ($user->has_role("classruk"))
            return $this->get($user->get_role_arg("classruk"));

        if ($user->has_role("student"))
            return $this->get($user->get_role_arg("student"));

        if ($user->has_role("vospit"))
            return $this->get($user->get_role_arg("vospit"));

        abort(403);
    }

    public function get($group) {
        $group = $this->groups->get($group);
        $group["users"] = $group["users"]->sort(function ($a, $b) {
            $pa = $a->student()->get_balance();
            $pb = $b->student()->get_balance();

            if ($pa != $pb)
                return -1 * ($pa <=> $pb);

            return \App\Utils::get_student_cmp()($a, $b);
        });

        return view("group.get", [
            "group" => $group
        ]);

}
    public function all() {
        $groups = $this->groups->get_all();
        $pars = $this->groups->get_pars();

        return view("group.all", [
            "groups" => $groups,
            "pars" => $pars
        ]);
    }
}
