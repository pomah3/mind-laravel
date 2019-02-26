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
        if (Auth::user()->has_role("classruk"))
            return $this->get(Auth::user()->get_role_arg("classruk"));

        if (Auth::user()->has_role("student"))
            return $this->get(Auth::user()->get_role_arg("student"));

        abort(403);
    }

    public function get($group) {
        $group = $this->groups->get($group);

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
