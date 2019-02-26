<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Lesson;
use App\Repositories\TimetableRepository;

class ProfileController extends Controller
{
    private $ttr;

    public function __construct(TimetableRepository $ttr) {
        $this->ttr = $ttr;
    }

    private function get_daytime() {
        $h = (new \DateTime())->format("H");
        $h = intval($h);

        $night   = "Доброй ночи" ;
        $morning = "Доброе утро" ;
        $day     = "Добрый день" ;
        $evening = "Добрый вечер";

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

    private function get_timetable_date() {
        $h = (new \DateTime())->format("H");
        $h = intval($h);

        if ($h < 16)
            return \Carbon\Carbon::now();
        else
            return new \Carbon\Carbon("tomorrow");
    }

    private function get_timetable() {
        if (Auth::user()->type != "student")
            return null;

        return $this->ttr->get_lessons(Auth::user())[
            $this->get_timetable_date()->format('l')
        ];
    }

    public function index() {
        return view("profile", [
            "daytime" => $this->get_daytime(),
            "date" => $this->get_timetable_date(),
            "timetable" => $this->get_timetable()
        ]);
    }
}
