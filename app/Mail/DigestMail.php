<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DigestMail extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    public $events;

    public function __construct(User $user) {
        $start = now()->startOfWeek();
        $end = now()->endOfWeek();

        $this->user = $user;
        $this->events = $user->events()
                             ->whereBetween("from_date", [$start, $end])
                             ->orWhere("till_date", [$start, $end])
                             ->get();
    }

    public function build() {
        return $this->view('email.digest')->subject("Еженедельный дайджест");
    }
}
