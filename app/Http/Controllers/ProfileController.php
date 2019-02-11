<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lesson;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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

        return Lesson::where("weekday", $this->get_timetable_date()->format('l'))
                     ->where("group", Auth::user()->student()->get_group())
                     ->get();
    }

    public function index() {
        return view("profile", [
            "daytime" => $this->get_daytime(),
            "date" => $this->get_timetable_date(),
            "timetable" => $this->get_timetable()
        ]);
    }
}
