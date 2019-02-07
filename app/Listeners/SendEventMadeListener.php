<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\EventMade as EventMadeEvent;
use App\Notifications\EventMade as EventMadeNotification;

class SendEventMadeListener
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
    public function handle(EventMadeEvent $event)
    {
        $event->event->users->each(function ($user) use ($event) {
            $user->notify(new EventMadeNotification($event->event));
        });
    }
}
