<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Events\{TransactionMade, QuestionAnswered, EventMade};
use App\Listeners\{SendPointsGotListener, SendQuestionAnsweredListener, SendEventMadeListener};

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        TransactionMade::class => [
            SendPointsGotListener::class
        ],
        QuestionAnswered::class => [
            SendQuestionAnsweredListener::class
        ],
        EventMade::class => [
            SendEventMadeListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
