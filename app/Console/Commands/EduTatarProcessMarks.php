<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Cause;
use App\Transaction;
use App\EduTatar\EduTatarAuth;

class EduTatarProcessMarks extends Command
{
    protected $signature = 'edutatar:marks';
    protected $description = 'Handle marks of all students who has login and password of edu tatar';

    private $eta;

    public function __construct(EduTatarAuth $eta) {
        parent::__construct();

        $this->eta = $eta;
    }

    public function handle() {
        $students = User::students()
                        ->whereNotNull("edu_tatar_login")
                        ->whereNotNull("edu_tatar_password")
                        ->get();

        foreach ($students as $student) {
            $login = $student->edu_tatar_login;
            $password = $student->edu_tatar_password;

            $this->info("Handling: $login");

            $marks = $this->get_marks($login, $password);
            $this->add_points($student, $marks);
        }
    }

    public function get_marks(string $login, string $password) {
        $page = $eta->get_page(
            "https://edu.tatar.ru/user/diary/term",
            $login,
            $password
        );

        preg_match_all("#<td>(\d)</td>#", $page, $marks);

        $marks = collect($marks[1])
                 ->map(function($a) {return intval($a);})
                 ->filter(function($a) {return $a>=2 && $a<=5;});

        return $marks;
    }

    private function add_points(User $student, $marks) {
        $cnt = [2=>0, 3=>0, 4=>0, 5=>0];
        foreach ($marks as $mark) {
            $cnt[$mark]++;
        }

        $this->add_points_($student, $cnt[2], Cause::find(6));
        $this->add_points_($student, $cnt[3], Cause::find(5));
        $this->add_points_($student, $cnt[4], Cause::find(4));
        $this->add_points_($student, $cnt[5], Cause::find(3));
    }

    private function add_points_(User $student, int $cnt, Cause $cause) {
        Transaction::where("to_id", $student->id)
                   ->where("cause_id", $cause->id)
                   ->delete();

        if ($cause->points == 0)
            return;

        $points = $cause->points * $cnt;
        Transaction::add(null, $student, $cause, $points, false);
    }

}
