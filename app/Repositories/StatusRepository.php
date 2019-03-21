<?php

namespace App\Repositories;

use App\{User, Status};

interface StatusRepository {
    public function get_all_statuses();

    public function get_statistics_by_day(\DateTime $date);
    public function get_statistics_between(\DateTime $start, \DateTime $end);

    public function get_status(User $user): Status;
    public function get_status_by_day(User $user, \DateTime $date): Status;
    public function set_status_title(User $user, string $status);
}
