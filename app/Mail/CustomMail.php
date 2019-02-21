<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $text;

    public function __construct(string $subject, string $text) {
        $this->text = $text;
        $this->subject = $subject;
    }

    public function build() {
        return $this->view('email.base')
                    ->subject($this->subject);
    }
}
