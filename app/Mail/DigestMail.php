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
        $this->user = $user;
        $this->events = $user->events;
    }

    public function build() {
        return $this->view('email.digest')->subject("Еженедельный дайджест");
    }
}
