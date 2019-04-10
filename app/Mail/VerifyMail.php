<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable {
    public $user;
    public $email;

    use Queueable, SerializesModels;

    public function __construct(User $user) {
        $this->user = $user;
        $this->email = $user->email;
    }

    public function build() {
        return $this->view('email.verify')->subject("Подтвердите email");
    }
}
