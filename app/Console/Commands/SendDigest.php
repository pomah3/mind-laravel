<?php

namespace App\Console\Commands;

use App\Mail\DigestMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendDigest extends Command {
    protected $signature = 'mind:send-digest';
    protected $description = 'Send digest email to all users';

    public function handle() {
        $users = User::whereNotNull("email")
                     ->whereNotNull("email_verified_at")
                     ->get();

        $_count = 0;

        foreach ($users as $user) {
            if ($user->events->count() > 0) {
                Mail::to($user)->send(new DigestMail($user));
                $_count++;
            }
        }

        Log::info("Executed mind:send-digest command", [
            "count" => $_count
        ]);
    }
}
