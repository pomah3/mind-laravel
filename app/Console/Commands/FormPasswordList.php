<?php

namespace App\Console\Commands;

use App\Mail\PasswordsMail;
use App\Repositories\GroupRepository;
use App\Roles;
use App\User;
use App\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class FormPasswordList extends Command {

    protected $signature = 'mind:form-passwords {--email}';
    protected $description = 'Send password list to admin';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $list = collect([]);

        $list = $list->merge($this->form_zams());
        $list = $list->merge($this->form_groups());

        $list = $this->get_text($list);

        if ($this->option("email"))
            $this->send($list);
        else
            $this->print($list);
    }

    private function form_zams() {
        $zams = User::all()->filter(function($user) {
            return $user->has_role(Roles::ZAM);
        });

        $ret = [
            "title" => "Замы",
            "users" => $zams
        ];

        return [$ret];
    }

    private function form_groups() {
        $students = User::students()->get();

        $students_by_group = [];
        foreach ($students as $student) {
            $group = $student->student()->get_group();
            $students_by_group[$group] = $students_by_group[$group] ?? [];

            $students_by_group[$group][] = $student;
        }

        $ret = [];
        foreach ($students_by_group as $group => $students) {
            $users = collect($students)->sort(Utils::get_student_cmp());
            $classruk = $students[0]->student()->get_classruk();
            $vospit = $students[0]->student()->get_vospit();

            if ($classruk)
                $users->prepend($classruk);
            if ($vospit)
                $users->prepend($vospit);

            $ret[] = [
                "title" => $group,
                "users" => $users
            ];
        }

        return $ret;
    }

    private function get_text($list) {
        return collect($list)->map(function($a) {
            return [
                "title" => $a["title"],
                "text" => collect($a["users"])->map(function($u) {
                    return $u->get_name() . ": " . $u->password;
                })->join("\n")
            ];
        });
    }

    private function print($list) {
        foreach ($list as $a) {
            $this->info($a["title"]);
            $this->info($a["text"]);
        }
    }

    private function send($list) {
        if (config("app.admin_email"))
            Mail::to(env("app.admin_email"))->send(new PasswordsMail($list));
    }
}
