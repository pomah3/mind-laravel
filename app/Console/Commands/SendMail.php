<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

abstract class SendMail extends Command {
    abstract function get_mail(User $user);

    public function handle() {
        $users = User::whereNotNull("email")
                     ->whereNotNull("email_verified_at")
                     ->get();

        $_count = 0;

        foreach ($users as $user) {
            $email = $this->get_mail($user);
            if (!$email)
                continue;

            Mail::to($user)->send();
            $_count++;
        }

        Log::info("Executed " . $this->signature . " command", [
            "count" => $_count
        ]);
    }
}
