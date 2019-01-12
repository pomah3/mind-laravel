<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Events\TransactionMade;

class Transaction extends Model {
    public static function of_student(User $user) {
        if ($user->type !== "student")
            return null;

        return Transaction::
            where("to_id", $user->id)->
            orWhere("from_id", $user->id)->
            get();
    }

    public function cause() {
        return $this->belongsTo(Cause::class);
    }

    public function get_to_user() {
        return User::find($this->to_id);
    }

    public function get_from_user() {
        return User::find($this->from_id);
    }

    public static function get_balance(User $user) {
        if ($user->type !== "student")
            return null;

        $plus = Transaction::where("to_id", $user->id)->sum("points");
        $minus = Transaction::where("from_id", $user->id)->sum("points");

        return $plus - $minus;
    }

    public static function add(User $from, User $to, int $points) {
        $tr = new Transaction;

        $tr->from_id = $from->id;
        $tr->to_id   = $to->id;
        $tr->points  = $points;
        $tr->cause_id   = 1;

        $tr->save();

        event(new TransactionMade($tr));
    }
}
