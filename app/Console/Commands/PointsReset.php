<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;
use App\User;

class PointsReset extends Command
{
    protected $signature = 'mind:reset-points';
    protected $description = 'Remove all transactions and add starting points';

    public function handle() {
        Transaction::query()->delete();

        foreach (User::where("type", "student")->get() as $student) {
            \App\Transaction::add(null, $student, \App\Cause::find(1), null, false);
        }
    }
}
