<?php

namespace App\Services;

use App\User;
use App\Cause;
use App\Transaction;

class TransactionServiceBasicImpl implements TransactionService {
    public function get_balance(User $user): int {
        $plus = Transaction::where("to_id", $user->id)->sum("points");
        $minus = Transaction::where("from_id", $user->id)->sum("points");

        return $plus - $minus;
    }

    public function add(?User $from, User $to, Cause $cause, int $points=null): Transaction {
        if ($points == null) {
            $points = $cause->points;
        }

        $tr = new Transaction;

        $tr->from_id  = $from ? $from->id : null;
        $tr->to_id    = $to->id;
        $tr->points   = $points;
        $tr->cause_id = $cause->id;

        $tr->save();

        return $tr;
    }

    public function delete(Transaction $tr) {
        $tr->delete();
    }

    public function deleteAll() {
        Transaction::query()->delete();
    }
}
