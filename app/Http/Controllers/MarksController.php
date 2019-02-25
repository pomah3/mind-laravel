<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EduTatar\EduTatarAuth;
use Illuminate\Support\Facades\Auth;

class MarksController extends Controller {
    function get_number_of_5($a) {
        $arr = [];
        $arr[2] = 0;
        $arr[3] = 0;
        $arr[4] = 0;
        $arr[5] = 0;
        foreach ($a as $i) {
            $arr[$i]++;
        }
        $v = 0;
        $sum = $arr[5] / 2 - $arr[4] / 2 - (3 * $arr[3]) / 2 - (5 * $arr[2]) / 2;
        while ($sum < 0) {
            $sum += 0.5;
            $v++;
        }
        return $v;
    }

    private function get_marks($login, $password) {
        $page = (new EduTatarAuth)->get_page(
            "https://edu.tatar.ru/user/diary/term",
            $login,
            $password
        );
        $body = preg_match("#<tbody>.+</tbody>#s", $page, $lessons);
        $lessons = $lessons[0];

        preg_match_all("#<tr>(.+?)</tr>#s", $lessons, $ls);

        $ret = [];

        foreach ($ls[1] as $l) {
            preg_match("#<td>(\D.+?)</td>#", $l, $name);
            if (!isset($name[1]))
                continue;
            preg_match_all("#<td>(\d)</td>#", $l, $marks);
            $marks = collect($marks[1])->map(function($a){return intval($a);});

            $ret[$name[1]] = $marks;
        }

        return $ret;
    }

    private function get_marks_($login, $password) {
        $m = $this->get_marks($login, $password);

        $ret = [];
        foreach ($m as $name => $marks) {
            $ret[] = [
                "marks" => $marks,
                "name" => $name,
                "need" => $this->get_number_of_5($marks),
            ];
        }

        return $ret;
    }

    public function index() {
        $user = Auth::user();
        $marks = [];
        $has_login = false;

        if (filled($user->edu_tatar_login) && filled($user->edu_tatar_password)) {
            $has_login = true;
            $marks = $this->get_marks_($user->edu_tatar_login, $user->edu_tatar_password);
        }

        return view("marks.index", [
            "has_login" => $has_login,
            "lessons" => $marks
        ]);
    }
}
