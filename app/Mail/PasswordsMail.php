<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordsMail extends Mailable {
    private $files;

    use Queueable, SerializesModels;

    public function __construct($files) {
        $this->files = $files;
    }

    public function build() {
        $view = $this->view('email.passwords')->subject("Пароли");
        foreach ($this->files as $file) {
            $view->attachData(
                $file["text"],
                $file["title"].".txt",
                [
                    "mime" => "text/plain"
                ]
            );
        }

        return $view;
    }
}
