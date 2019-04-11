<?php

namespace App\Repositories;

use App\Lesson;
use App\User;
use App\Utils;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class LessonRepositoryWeeklyImpl implements LessonRepository {
    public function get_lessons(User $user, Carbon $from, Carbon $until) {
        $from = $from->copy();
        $until = $until->copy();

        $lessons_ret = collect([]);

        while ($from <= $until) {
            $in_day = $this->get_lessons_raw($user, $from);

            $lessons_ret = $lessons_ret->merge($in_day);
            $from->addDay(1);
        }

        return $lessons_ret;
    }

    public function has_lessons(User $user, Carbon $from, Carbon $until) {
        $lessons = $this->get_lessons($user, $from, $until);
        return filled($lessons);
    }

    private function get_lessons_arr(User $user, string $weekday) {
        if ($user->type == "student")
            return DB::table("lessons")
                     ->where("group", $user->student()->get_group())
                     ->where("weekday", $weekday)
                     ->get();
        else
            return DB::table("lessons")
                     ->where("teacher_id", $user->id)
                     ->where("weekday", $weekday)
                     ->get();
    }

    private function get_lessons_raw(User $user, Carbon $date) {
        $weekday = $date->format("l");

        $lessons = $this->get_lessons_arr($user, $weekday);

        return $lessons->map(function($a) use ($date) {
            $start = new Carbon($a->time_from);
            $end = new Carbon($a->time_until);

            $start = Utils::get_day_date($start, $date);
            $end = Utils::get_day_date($end, $date);

            return new Lesson(
                $a->lesson,
                $start,
                $end
            );
        });
    }
}
