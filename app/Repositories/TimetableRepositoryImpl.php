<?php

namespace App\Repositories;

use App\Event;
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
        $events = $this->lessons_repo->get_lessons($user, $start, $end);
        $events = $events->merge($this->get_events($user, $start, $end));

        return $events;
    }

    public function has_items(User $user, Carbon $start, Carbon $end) {
        $events = $this->get_items($user, $start, $end);
        return filled($events);
    }

    private function get_events(User $user, Carbon $start, Carbon $end) {
        return $user->events()
                    ->whereBetween("from_date", [$start, $end])
                    ->orWhere("till_date", [$start, $end])
                    ->get();
    }
}
