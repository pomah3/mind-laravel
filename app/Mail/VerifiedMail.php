<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifiedMail extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    public $email;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function build() {
        return $this->view('email.verified')->subject("Email подтверждён");
    }
}
