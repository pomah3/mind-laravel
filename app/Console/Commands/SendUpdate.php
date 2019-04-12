<?php

namespace App\Console\Commands;

use App\Mail\UpdateMail;
use App\User;
use Illuminate\Console\Command;

class SendUpdate extends SendMail {
    protected $signature = 'mind:send-update {version}';
    protected $description = 'Send update email to all users';

    public function get_mail(User $user) {
        return new UpdateMail($this->argument('version'));
    }
}
