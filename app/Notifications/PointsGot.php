<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\Transaction;

class PointsGot extends Notification
{
    use Queueable;

    private $tr;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Transaction $tr)
    {
        $this->tr = $tr;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "transaction" => $this->tr,
            "view" => "notifications.points_got"
        ];
    }
}
