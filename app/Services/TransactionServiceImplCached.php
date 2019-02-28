<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

use App\{Cause, Transaction, User};
use App\Events\TransactionMade;

class TransactionServiceImplCached extends TransactionServiceImpl {
    private $pref = "user_balance.";
    private $time = 5;

    public function get_balance(User $user): int {
        return Cache::remember($this->pref.$user->id, $this->time, function() use ($user) {
            return parent::get_balance($user);
        });
    }

    public function add(?User $from, User $to, Cause $cause, int $points=null): Transaction {
        $tr = parent::add($from, $to, $cause, $points);

        if ($from)
            $this->recache($from);
        $this->recache($to);

        event(new TransactionMade($tr));
        return $tr;
    }

    public function delete(Transaction $tr) {
        parent::delete($tr);
        if ($tr->from)
            $this->recache($tr->from);
        $this->recache($tr->to);
    }

    public function deleteAll() {
        parent::deleteAll();
        Cache::flush();
    }

    private function recache(User $user) {
        $balance = parent::get_balance($user);
        Cache::put(
            $this->pref.$user->id,
            $balance,
            $this->time
        );
    }
}
