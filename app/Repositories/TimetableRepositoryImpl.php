<?php

namespace App\Repositories;

use App\Lesson;
use App\Role;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TimetableRepositoryImpl implements TimetableRepository {
    private $lessons_repo;

    public function __construct(LessonRepository $lessons_repo) {
        $this->lessons_repo = $lessons_repo;
    }

    public function get_items(User $user, Carbon $start, Carbon $end) {
        return $this->lessons_repo->get_lessons($user, $start, $end);
    }

    public function has_items(User $user, Carbon $start, Carbon $end) {
        return $this->lessons_repo->get_lessons($user, $start, $end);
    }
}
