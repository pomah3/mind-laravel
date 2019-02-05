<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function index() {
        return view("profile", [
            "daytime" => $this->get_daytime(),
            "date" => $this->get_timetable_date()
        ]);
    }
}
