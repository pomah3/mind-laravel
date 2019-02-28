<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

use App\{Cause, Transaction, User};
use App\Events\TransactionMade;

class TransactionServiceImpl extends TransactionServiceBasicImpl {
    private $pref = "user_balance.";
    private $time = 5;

    public function get_balance(User $user): int {
        return Cache::remember($this->pref.$user->id, $this->time, function() use ($user) {
            return parent::get_balance($user);
        });
    }

    public function add(?User $from, User $to, Cause $cause, int $points=null): Transaction {
        $tr = parent::add($from, $to, $cause, $points);

        if ($from) {
            $b = parent::get_balance($from);
            Cache::put($this->pref.$from->id, $b, $this->time);
        }

        $b = parent::get_balance($to);
        Cache::put($this->pref.$to->id, $b, $this->time);

        event(new TransactionMade($tr));
        return $tr;
    }
}
