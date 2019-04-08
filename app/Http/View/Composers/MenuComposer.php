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
            ["menu.points.mine", "/points", ["student"]],
            ["menu.points.give", "/points/give", ["student"]],
            ["menu.points.add", "/points/add", ["can", "add-index-points"]],
            ["menu.groups", "/groups", ["can", "view-all-groups"]],
            ["menu.points.group", "/groups/mine", ["or", "classruk", "student", "vospit"]],
        ],
        [
            "menu.admin",
            ["menu.data", "/data", ["can", "view-data"]],
            ["menu.users", "/users", ["can", "view", \App\User::class]],
            ["menu.banners", "/banners", ["can", "view", \App\Banner::class]],
            ["menu.email", "/email", ["can", "send-email"]]
        ],
        ["menu.polls", "/polls", "all"],
        ["menu.events", "/events", "all"],
        [
            "menu.timetable",
            '/timetable', [
                "and",
                ["can", "see-timetable"],
                ["not", "admin"]
            ]
        ],
        ["menu.marks", '/marks', "student"],
        ["menu.status", '/status', ["can", "see-index-status"]],
        ["menu.questions", '/questions', "all"],
        ["menu.documents", "/documents", "all"],
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
