<?php

namespace App\Repositories;
use App\User;
use App\Role;
use App\Lesson;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class TimetableRepositoryImpl implements TimetableRepository {
    public function get_days() {
        return [
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday"
        ];
    }

    public function get_lessons(User $user) {
        $group = $user->student()->get_group();
        return $this->get_lessons_($group);
    }

    private function get_lessons_($group) {
        return Cache::remember("lessons.group.$group", 5, function() use ($group) {
            $lessons = [];

            foreach ($this->get_days() as $day) {
                $lessons[$day] = Lesson
                    ::where("weekday", $day)
                    ->where("group", $group)
                    ->orderBy("number")
                    ->get()
                    ->filter(function($a) {
                        return $a->number <= 7;
                    });
            }

            return $lessons;
        });
    }
}
