<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Events\TransactionMade;

class Transaction extends Model {
    public static function of_student(User $user) {
        return Transaction::
            where("to_id", $user->id)->
            orWhere("from_id", $user->id);
    }

    public function cause() {
        return $this->belongsTo(Cause::class);
    }

    public function getToUserAttribute() {
        return User::find($this->to_id);
    }

    public function getFromUserAttribute() {
        return User::find($this->from_id);
    }

    public static function get_balance(User $user) {
        // return Cache::remember("balance.".$user->id, now()->addSeconds(5), function() use ($user) {
            $plus = Transaction::where("to_id", $user->id)->sum("points");
            $minus = Transaction::where("from_id", $user->id)->sum("points");

            return $plus - $minus;
        // });
    }

    public static function add(?User $from, User $to, Cause $cause, int $points=null, bool $need_event=true): Transaction {
        if ($points == null) {
            $points = $cause->points;
        }

        $tr = new Transaction;

        $tr->from_id = $from ? $from->id : null;
        $tr->to_id   = $to->id;
        $tr->points  = $points;
        $tr->cause_id = $cause->id;

        $tr->save();

        if ($need_event)
            event(new TransactionMade($tr));

        return $tr;
    }
}
