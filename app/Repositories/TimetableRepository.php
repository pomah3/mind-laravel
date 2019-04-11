<?php

namespace App\Repositories;
use App\User;
use Illuminate\Support\Carbon;

interface TimetableRepository {
    public function get_items(User $user, Carbon $start, Carbon $end);
    public function has_items(User $user, Carbon $start, Carbon $end);
}
