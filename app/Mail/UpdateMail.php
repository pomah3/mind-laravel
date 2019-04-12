<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateMail extends Mailable {
    public $version;

    use Queueable, SerializesModels;

    public function __construct($version) {
        $this->version = $version;
    }

    public function build() {
        return $this->view('email.update')->subject("Обновление!");
    }
}
