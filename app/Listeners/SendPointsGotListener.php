<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\TransactionMade;
use App\Notifications\PointsGot;

class SendPointsGotListener {
    public function handle(TransactionMade $event) {
        $tr = $event->transaction;

        if ($tr->from_user == null)
            return;

        $tr->to_user->notify(new PointsGot($event->transaction));
    }
}
