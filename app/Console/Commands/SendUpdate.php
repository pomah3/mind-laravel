<?php

namespace App\Console\Commands;

use App\Mail\DigestMail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendUpdate extends SendMail {
    protected $signature = 'mind:send-update {version}';
    protected $description = 'Send update email to all users';

    public function get_mail(User $user) {
        return new UpdateMail($this->argument('version'));
    }
}
