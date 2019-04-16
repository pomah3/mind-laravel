<?php

namespace App\Console\Commands;

use App\Mail\DigestMail;
use App\User;
use Illuminate\Console\Command;

class SendDigest extends SendMail {
    protected $signature = 'mind:send-digest';
    protected $description = 'Send digest email to all users';

    public function get_mail(User $user) {
        if ($user->events->count() > 0) {
            return new DigestMail($user);
        return null;
    }
}
