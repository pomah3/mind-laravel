<?php

namespace App;

use App\Document;
use App\User;
use Illuminate\Support\Carbon;
use PhpOffice\PhpWord\TemplateProcessor;

class Utils {
    public static function sep_group($group) {
        return explode('-', $group);
    }

    public static function get_group_cmp(): \Closure {
        return function(string $gr1, string $gr2): int {
            [$par1, $lit1] = explode('-', $gr1);
            [$par2, $lit2] = explode('-', $gr2);

            $par1 = intval($par1);
            $par2 = intval($par2);

            if ($par1 != $par2)
                return $par1 <=> $par2;
            return $lit1 <=> $lit2;
        };
    }

    public static function get_student_cmp(): \Closure {
        $lex_student_cmp = function(User $st1, User $st2): int {
            $gr1 = $st1->student()->get_group();
            $gr2 = $st2->student()->get_group();

            if ($gr1 != $gr2) {
                return static::get_group_cmp()($gr1, $gr2);
            }

            return static::get_user_cmp()($st1, $st2);
        };

        $points_student_cmp = function(User $st1, User $st2) use($lex_student_cmp): int {
            $p1 = $st1->student()->get_balance();
            $p2 = $st2->student()->get_balance();

            if ($p1 == $p2)
                return $lex_student_cmp($st1, $st2);

            return -1 * ($p1 <=> $p2);
        };

        return $lex_student_cmp;
    }

    public static function get_user_cmp(): \Closure {
        return function(User $u1, User $u2) {
            if ($u1->family_name != $u2->family_name)
                return $u1->family_name <=> $u2->family_name;

            if ($u1->given_name != $u2->given_name)
                return $u1->given_name <=> $u2->given_name;

            if ($u1->father_name != $u2->father_name)
                return $u1->father_name <=> $u2->father_name;

            return 0;
        };
    }

    public static function get_today_date(\DateTime $date) {
        $today = \Carbon\Carbon::today();
        $h = intval($date->format("H"));
        $m = intval($date->format("i"));
        $s = intval($date->format("s"));

        $today->setTime($h, $m, $s);

        return $today;
    }

    public static function get_day_date(Carbon $date, Carbon $day) {
        $day = $day->copy();

        $h = intval($date->format("H"));
        $m = intval($date->format("i"));
        $s = intval($date->format("s"));

        $day->setTime($h, $m, $s);

        return $day;
    }

    public static function generate_password(): string {
        if (config("app.password.is_default"))
            return config("app.password.default", "123");

        return str_random(config("app.password.length", 4));
    }

    public static function word_template(string $file, array $fields) {
        $template = new TemplateProcessor(resource_path($file));

        foreach ($fields as $key => $value)
            $template->setValue($key, $value);

        $doc = Document::create("Распоряжение", ["not", "all"], User::find(1));
        $doc->set_ext("docx");

        $template->saveAs($doc->get_full_path());

        return $doc;
    }
}
