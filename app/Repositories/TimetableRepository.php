<?php

namespace App\Repositories;
use App\User;

interface TimetableRepository {
    public function get_lessons(User $user);
    public function has_lessons(User $user);
}
