<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable
{
    use Queueable, SerializesModels;

    public $text;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function build() {
        return $this->view('email.base');
    }
}
