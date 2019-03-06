<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Repositories\GroupRepository;
use App\User;

class StatusController extends Controller
{
    public function index(GroupRepository $gr) {
        $this->authorize("see-status-index");

        $groups = $gr->get_all();

        foreach ($groups as &$group) {
            $group["users"] = $group["users"]->filter(function($u) {
                return Auth::user()->can("see-status", $u) ||
                       Auth::user()->can("set-status", $u);
            })->values();
        }

        $groups = $groups->filter(function($g) {
            return filled($g["users"]);
        });

        $pars = $gr->get_pars();

        return view("status.index", [
            "groups" => $groups,
            "pars" => $pars
        ]);
    }

    public function set(User $user, string $status) {
        $this->authorize("set-status", $user);

        $user->status->title = $status;
        $user->status->save();
        return "";
    }

    public function statistic() {
        return collect([
            "П", "БД", "БИ", "УП", "В"
        ])->map(function($a) {
            return DB::table("statuses")->where("title", $a)->count();
        });


    }
}
