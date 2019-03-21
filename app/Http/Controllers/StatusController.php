<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Repositories\GroupRepository;
use App\Repositories\StatusRepository;
use App\User;

class StatusController extends Controller {
    private $status_r;

    public function __construct(StatusRepository $status_r) {
        $this->status_r = $status_r;
    }

    public function index(GroupRepository $gr) {
        $this->authorize("see-index-status");

        $groups = $gr->get_all();

        foreach ($groups as &$group) {
            $group["users"] = $group["users"]->filter(function($u) {
                return Auth::user()->can("see-status", $u) ||
                       Auth::user()->can("set-status", $u);
            })->values();
        }

        $groups = $groups->filter(function($g) {
            return filled($g["users"]);
        })->values();

        $pars = $gr->get_pars();

        return view("status.index", [
            "groups" => $groups,
            "pars" => $pars,
            "status_r" => $this->status_r
        ]);
    }

    public function set(User $user, string $status) {
        $this->authorize("set-status", $user);

        $this->status_r->set_status_title($user, $status);
        return "";
    }

    private function get_study_year_start() {
        $start = now()->startOfDay();
        if ($start->month >= 1)
            $start->subYear(1);

        $start->month(9)->day(1);
        return $start;
    }

    public function statistic() {
        $start = $this->get_study_year_start();
        $end = now();

        return view("status.statistic", [
            "days" => $this->status_r->get_statistics_between($start, $end)
        ]);
    }
}
