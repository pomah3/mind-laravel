<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\TransactionMade;
use App\Notifications\PointsGot;

class SendPointsGotListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionMade  $event
     * @return void
     */
    public function handle(TransactionMade $event)
    {
        $event->transaction->get_to_user()->notify(new PointsGot($event->transaction));
    }
}
