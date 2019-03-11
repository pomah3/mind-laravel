<?php

namespace App\Repositories;

use App\{User, Status};

interface StatusRepository {
    public function get_all_statuses();
    public function get_statistics();

    public function get_status(User $user): Status;
    public function set_status(User $user, string $status);
}
