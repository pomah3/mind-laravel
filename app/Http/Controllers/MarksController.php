<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EduTatar\EduTatarAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class MarksController extends Controller {
    private $eta;

    public function __construct(EduTatarAuth $eta) {
        $this->eta = $eta;
    }

    private function get_marks($login, $password) {
        $page = $this->eta->get_page(
            "/user/diary/term",
            $this->eta->get_key(
                $login,
                $password
            )
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
        // return Cache::remember("edu.marks.$login", 10, function() use($login, $password) {
            $m = $this->get_marks($login, $password);

            $ret = [];
            foreach ($m as $name => $marks) {
                $ret[] = [
                    "marks" => $marks,
                    "name" => $name,
                ];
            }

            return $ret;
        // });
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
