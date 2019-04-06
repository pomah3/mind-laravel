<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyMail extends Mailable {
    private $user;

    use Queueable, SerializesModels;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function build() {
        return $this->view('email.verify', [
            "user" => $this->user
        ])->subject("Подтвердите email");
    }
}
