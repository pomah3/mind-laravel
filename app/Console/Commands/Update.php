<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class Update extends Command {
    protected $signature = 'mind:update {branch=master}';
    protected $description = 'Do some thing to update';

    public function handle() {
        $branch = $this->argument('branch');

        system("git checkout $branch");
        system("git pull");

        system("composer install");

        Artisan::call("cache:clear");
        Cache::flush();

        Artisan::call("migrate");
        Artisan::call("config:cache");
        Artisan::call("view:cache");

        system("npm i");
        system("npm run prod");
    }
}
