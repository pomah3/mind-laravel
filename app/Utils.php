<?php

namespace App;

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
        return function(User $st1, $st2): int {
            $gr1 = $st1->student()->get_group();
            $gr2 = $st2->student()->get_group();

            if ($gr1 != $gr2) {
                return static::get_group_cmp()($gr1, $gr2);
            }

            if ($st1->family_name != $st2->family_name)
                return $st1->family_name <=> $st2->family_name;

            if ($st1->given_name != $st2->given_name)
                return $st1->given_name <=> $st2->given_name;

            if ($st1->father_name != $st2->father_name)
                return $st1->father_name <=> $st2->father_name;

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

    public static function generate_password(): string {
        if (config("app.password.is_default"))
            return config("app.password.default", "123");

        return str_random(config("app.password.length", 4));
    }
}
