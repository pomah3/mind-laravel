<?php

namespace App\Repositories;

use App\{User, Status};

class StatusRepositoryImpl implements StatusRepository {
    public function get_all_statuses() {
        return [
            "П", "БД", "БИ", "УП", "В"
        ];
    }

    public function get_statistics() {
        return [];
    }

    public function get_status(User $user): Status {
        return $user->status;
    }

    public function set_status(User $user, string $status) {
        $user->status->title = $status;
        $user->status->save();
    }
}
