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
        $titles = $this->get_all_statuses();

        $days = [];
        foreach (Status::all() as $status) {
            $date = (string)$status->updated_at->startOfDay();
            $days[$date] = $days[$date] ?? [];
            $days[$date][] = $status;
        }

        $user_count = DB::table("users")->count();

        $days = collect($days)->map(function($statuses) use ($user_count) {
            $grouped = [];

            $sum = 0;

            foreach ($statuses as $status) {
                $title = $status->title;
                $grouped[$title] = $grouped[$title] ?? 0;

                $grouped[$title]++;
                $sum++;
            }

            $grouped[$this->get_unknown_status()] = $user_count - $sum;

            foreach ($this->get_all_statuses() as $tit) {
                $grouped[$tit] = $grouped[$tit] ?? 0;
            }

            return $grouped;
        });

        $data = [];
        foreach ($days as $date => $titles) {
            $data[] = [
                "date" => new \Carbon\Carbon($date),
                "statistics" => $titles
            ];
        }

        return collect($data)->sortByDesc("date");
    }

    public function get_status(User $user): Status {
        $status = Status::where("user_id", $user->id)
                        ->where("updated_at", ">=", now()->startOfDay())
                        ->where("updated_at", "<=", now()->endOfDay())
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
