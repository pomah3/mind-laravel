<?php

namespace App\Services;

use App\User;
use App\Cause;
use App\Transaction;

interface TransactionService {
    public function get_balance(User $user): int;
    public function add(?User $from, User $to, Cause $cause, int $points=null): Transaction;
    public function delete(Transaction $tr);
    public function deleteAll();
}
