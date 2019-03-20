<?php

namespace App\Repositories;

use App\{User, Status};
use Illuminate\Support\Facades\DB;

class StatusRepositoryImpl implements StatusRepository {
    public function get_all_statuses() {
        return [
            "П", "БД", "БИ", "УП", "В"
        ];
    }

    public function get_unknown_status() {
        return "ХЗ";
    }

    public function get_statistics() {
        $data = [];

        foreach ($this->get_all_statuses() as $status) {
            $data[$status] = DB::table("statuses")->where("title", $status)->count();
        }

        $a = DB::select("select count(id) as count from users where id not in (select user_id from statuses)");
        $data[$this->get_unknown_status()] = $a[0]->count;

        return $data;
    }

    public function get_status(User $user): Status {
        return $user->status;
    }

    public function set_status(User $user, string $status) {
        $user->status->title = $status;
        $user->status->save();
    }
}
