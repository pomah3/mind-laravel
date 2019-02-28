<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;
use App\User;
use App\Cause;

use App\Services\TransactionService;

class PointsReset extends Command
{
    protected $signature = 'mind:reset-points';
    protected $description = 'Remove all transactions and add starting points';

    public function handle(TransactionService $trans) {
        $trans->deleteAll();

        $cause = Cause::find(1);
        if ($cause->points == 0)
            return;

        foreach (User::where("type", "student")->get() as $student) {
            $trans->add(null, $student, $cause);
        }
    }
}
