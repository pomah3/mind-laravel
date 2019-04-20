<?php

namespace App\Services;

use App\Repositories\GroupRepository;
use App\User;
use App\Utils;

class UserSelectServiceImpl implements UserSelectService {
    private $group_repo;

    public function __construct(GroupRepository $group_repo) {
        $this->group_repo = $group_repo;
    }

    public function get_variants() {
        $users = User::all()->map(function($user) {
            return [
                "title" => $user->get_name(),
                "type" => "id",
                "id" => $user->id,
            ];
        });

        $groups = collect($this->group_repo->get_names())
            ->map(function($group) {
                return [
                    "title" => "Группа $group",
                    "type" => "group",
                    "group" => $group
                ];
            });

        $pars = collect($this->group_repo->get_pars())
            ->map(function($par) {
                return [
                    "title" => "$par параллель",
                    "type" => "par",
                    "par" => $par
                ];
            });

        return collect($users)
            ->merge($groups)
            ->merge($pars);
    }

    public function get_users($v) {
        $type = $v["type"];
        if ($type == "id")
            return [User::find($v["id"])];

        if ($type == "group")
            return $this->group_repo->get($v["group"])["users"];

        if ($type == "par")
            return $this
                ->group_repo
                ->get_all()
                ->filter(function($group) use ($v) {
                    return Utils::sep_group($group["group"])[0] == $v["par"];
                })->map(function($group) {
                    return $group["users"];
                })->flatten();

        return [];
    }
}
