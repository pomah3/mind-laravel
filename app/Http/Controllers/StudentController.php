<?php

namespace App\Http\Controllers;

use App\User;
use App\Utils;
use App\ViewModels\StudentViewModel;
use Illuminate\Http\Request;

class StudentController extends Controller {
    protected $allowed_fields = [
        "student_id", "given_name", "family_name", "father_name",
        "email", "room", "level", "phone", "birthday", "fio",
        "group", "par"

    ];

    public function student_list_prepare() {
        $this->authorize("see-student-list");

        return view("student.prepare", [
            "fields" => $this->allowed_fields
        ]);
    }

    public function index(Request $request) {
        $this->authorize("see-student-list");

        $fields = $this->get_fields($request->fields);
        $users = $this->get_users($request, $fields);

        return view(
            "student.show", new StudentViewModel($users, $fields)
        );
    }

    private function get_users(Request $request, $fields) {
        $fields = collect($fields);
        $query = User::students()->join(
            'student_infos', 'users.id', '=', 'student_infos.student_id'
        )->join('roles', function($join) {
            $join->on("roles.user_id", "=", 'users.id')
                 ->where("roles.role", 'student')
                 ;
        })->select("*", "roles.role_arg AS group");

        $students = $query->get();

        $adds = $fields->intersect(collect($this->addictions())->keys());

        $students = collect($students)
            ->map(function($a) {
                return collect($a->toArray());
            })
            ->map(function($a) use ($fields, $adds) {
                $add = $adds->map(function($ad) use ($a) {
                    return $this->addictions()[$ad]($a);
                });

                $add = $adds->combine($add);

                return $a->only($fields)->merge($add);
            });

        return $students;
    }

    private function addictions() {
        return [
            "fio" => function($user) {
                return $user["family_name"] . ' ' . $user["given_name"] . ' ' . $user["father_name"];
            },
            "par" => function($user) {
                return Utils::sep_group($user["group"])[0];
            },
            "level" => function($user) {
                if (!$user["room"])
                    return null;
                return $user["room"][0];
            }
        ];
    }

    private function get_fields(?string $query) {
        if ($query == null)
            return $this->allowed_fields;

        $fields = explode(',', $query);
        return collect($fields)->intersect($this->allowed_fields);
    }
}
