<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

abstract class SendMail extends Command {
    abstract function get_mail(User $user);

    public function handle() {
        $users = User::whereNotNull("email")
                     ->whereNotNull("email_verified_at")
                     ->get();

        $_count = 0;

        foreach ($users as $user) {
            if ($user->events->count() > 0) {
                Mail::to($user)->send($this->get_mail($user));
                $_count++;
            }
        }

        Log::info("Executed " . $this->signature . " command", [
            "count" => $_count
        ]);
    }
}
