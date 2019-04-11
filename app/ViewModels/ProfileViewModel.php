<?php

namespace App\ViewModels;

use App\Lesson;
use App\Repositories\TimetableRepository;
use App\TimetableItem;
use App\User;
use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class ProfileViewModel extends ViewModel {
    use TimetableUtils;

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
        $day = $this->date()->copy();
        $items = $this->ttr->get_items(
            $this->user,
            $day->copy()->startOfDay(),
            $day->copy()->endOfDay()
        );

        return $this->sort_events($items);
    }

    public function is_now(TimetableItem $item) {
        return
            $item->get_start() < now() &&
            now() < $item->get_end();
    }

    public function show_tommorow() {
        $h = now()->format("H");
        $h = intval($h);

        return $h >= 16;
    }

    public function date() {
        if ($this->show_tommorow())
            return new Carbon("tomorrow");
        else
            return Carbon::today();
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
