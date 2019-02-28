<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;
use App\User;
use App\Cause;
use Illuminate\Support\Facades\DB;

use App\Services\TransactionService;

class PointsReset extends Command
{
    protected $signature = 'mind:reset-points';
    protected $description = 'Remove all transactions and add starting points';

    public function handle(TransactionService $trans) {
        DB::table("notifications")->truncate();

        $trans->deleteAll();

        $cause = Cause::find(1);
        if ($cause->points == 0)
            return;

        DB::insert('
            insert into transactions (
                to_id, cause_id, points, created_at, updated_at
            ) select id, ?, ?, ?, ? from users
            where type = "student"
        ', [$cause->id, $cause->points, now(), now()]);
    }
}
