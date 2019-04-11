<?php

namespace App\Repositories;

use App\User;
use Illuminate\Support\Carbon;

interface LessonRepository {
    public function get_lessons(User $user, Carbon $from, Carbon $until);
    public function has_lessons(User $user, Carbon $from, Carbon $until);
}
