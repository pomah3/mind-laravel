<?php

namespace App\Console\Commands;

use App\Mail\DigestMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendDigest extends SendMail {
    protected $signature = 'mind:send-digest';
    protected $description = 'Send digest email to all users';

    public function get_mail(User $user) {
        return new DigestMail($user);
    }
}
