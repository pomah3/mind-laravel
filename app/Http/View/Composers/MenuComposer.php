<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Role;

class MenuComposer {
    private $buttons = [
        ["menu.profile", "/", "logined"],
        [
            "menu.points.main",
            ["menu.points.mine", "/points", "student"],
            ["menu.points.give", "/points/give", "student"],
            ["menu.points.add", "/points/add", "teacher"],
        ],
        ["menu.timetable", '/timetable', "student"],
    ];

    public function compose(View $view) {
        $view->with('menu_items', $this->flat_buttons());
    }

    private function flat_buttons() {
        $ret = [];
        $user = Auth::user();

        foreach ($this->buttons as $button) {
            if (is_array($button[1])) {
                $title = $button[0];

                $ret_but = [];
                for ($i=1; $i < count($button); $i++) {
                    if (Role::has_complex_role($user, $button[$i][2])) {
                        $ret_but[] = [
                            "title" => $button[$i][0],
                            "url" => $button[$i][1]
                        ];
                    }
                }

                if (count($ret_but) > 0)
                    $ret[] = [
                        "title" => $title,
                        "submenu" => true,
                        "buttons" => $ret_but
                    ];

            } else {
                if (Role::has_complex_role($user, $button[2])) {
                    $ret[] = [
                        "title" => $button[0],
                        "submenu" => false,
                        "url" => $button[1]
                    ];
                }
            }
        }

        return $ret;
    }
}
