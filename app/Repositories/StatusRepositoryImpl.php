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

    public function get_statistics_by_day(\DateTime $date) {
        $date = new \Carbon\Carbon($date->format("c"));

        $data = [];

        $titles = $this->get_all_statuses();
        foreach ($titles as $title) {
            $count = DB::table("statuses")
                       ->where("title", $title)
                       ->whereBetween("updated_at", [
                           $date->copy()->startOfDay(),
                           $date->copy()->endOfDay()
                       ])
                       ->count();

            $data[$title] = $count;
        }

        return $data;
    }

    public function get_statistics_between(\DateTime $start, \DateTime $end) {
        $start = new \Carbon\Carbon($start->format("c"));
        $end = new \Carbon\Carbon($end->format("c"));

        $stats = [];
        while ($start <= $end) {
            $stat = $this->get_statistics_by_day($start);

            $stats[] = [
                "date" => $start->copy()->startOfDay(),
                "statistics" => $stat
            ];

            $start->addDays(1);
        }
        return $stats;
    }

    public function get_status(User $user): Status {
        return $this->get_status_by_day($user, now());
    }

    public function get_status_by_day(User $user, \DateTime $date): Status {
        $date = new \Carbon\Carbon($date->format('c'));

        $status = Status::where("user_id", $user->id)
                        ->where("updated_at", ">=", $date->copy()->startOfDay())
                        ->where("updated_at", "<=", $date->copy()->endOfDay())
                        ->first();

        if ($status)
            return $status;

        $status = new Status;
        $status->user_id = $user->id;
        $status->title = $this->get_unknown_status();

        return $status;
    }

    public function set_status_title(User $user, string $title) {
        $status = $this->get_status($user);

        $need_new = $status->title == $this->get_unknown_status();

        if ($need_new) {
            $status = new Status;
            $status->user_id = $user->id;
        }

        $status->title = $title;
        $status->save();
    }
}
