<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model {
    public static function of_student(User $user) {
        if ($user->type !== "student")
            return null;

        return Transaction::
            where("to_id", $user->id)->
            orWhere("from_id", $user->id)->
            get();
    }

    public static function balance(User $user) {
        if ($user->type !== "student")
            return null;

        $plus = Transaction::where("to_id", $user->id)->sum("points");
        $munis = Transaction::where("from_id", $user->id)->sum("points");

        return $plus - $minus;
    }
}
