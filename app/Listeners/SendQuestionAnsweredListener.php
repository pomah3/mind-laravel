<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\QuestionAnswered as QuestionAnsweredEvent;
use App\Notifications\QuestionAnswered;

class SendQuestionAnsweredListener
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
    public function handle(QuestionAnsweredEvent $event)
    {
        $event->question->asker->notify(new QuestionAnswered($event->question));
    }
}
