<?php

namespace App\ViewModels;

use App\Lesson;
use App\Repositories\TimetableRepository;
use App\User;
use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ProfileViewModel extends ViewModel {
    private $ttr;
    public $user;

    public function __construct(TimetableRepository $ttr, User $user) {
        $this->user = $user;
        $this->ttr = $ttr;
    }

    public function user_name() {
        if ($this->user->type == "student")
            return $this->user->get_name("gi");
        else
            return $this->user->get_name("gi ft");
    }

    public function timetable() {
        $day = $this->date()->format('l');
        return $this->ttr->get_lessons($this->user)[$day];
    }

    public function is_now(Lesson $lesson) {
        return
            $lesson->time_from < now() &&
            now() < $lesson->time_until;
    }

    public function show_tommorow() {
        $h = now()->format("H");
        $h = intval($h);

        return $h >= 16;
    }

    public function date() {
        if ($this->show_tommorow())
            return new \Carbon\Carbon("tomorrow");
        else
            return \Carbon\Carbon::now();
    }

    public function today_or_tommorow() {
        if ($this->show_tommorow())
            return trans('profile.timetable.tomorrow');
        else
            return trans('profile.timetable.today');
    }

    public function daytime() {
        $h = now()->format("H");
        $h = intval($h);

        $night   = "profile.greeting.night" ;
        $morning = "profile.greeting.morning" ;
        $day     = "profile.greeting.day" ;
        $evening = "profile.greeting.evening";

        if ($h < 5)
            return $night;
        elseif ($h < 12)
            return $morning;
        elseif ($h < 16)
            return $day;
        elseif ($h < 22)
            return $evening;

        return $night;
    }
}
