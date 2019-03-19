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
        if ($user->type == "student") {
            $group = $user->student()->get_group();
            return $this->get_lessons_group($group);
        } else {
            return $this->get_lessons_teacher($user);
        }
    }

    private function get_lessons_group($group) {
        return Cache::remember("lessons.group.$group", 5, function() use ($group) {
            $lessons = [];

            foreach ($this->get_days() as $day) {
                $lessons[$day] = Lesson
                    ::where("weekday", $day)
                    ->where("group", $group)
                    ->orderBy("number")
                    ->get()
                    /*->filter(function($a) {
                        return $a->number <= 7;
                    })*/;
            }

            return $lessons;
        });
    }

    private function get_lessons_teacher($teacher) {
        $lessons = [];

        foreach ($this->get_days() as $day) {
            $lessons[$day] = Lesson
                ::where("weekday", $day)
                ->where("teacher_id", $teacher->id)
                ->orderBy("number")
                ->get()
                /*->filter(function($a) {
                    return $a->number <= 7;
                })*/;
        }

        return $lessons;
    }

    public function has_lessons(User $user) {
        return collect($this->get_lessons($user))->flatten()->count() > 0;
    }
}
