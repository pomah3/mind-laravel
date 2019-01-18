<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('mind:init', function () {
    $this->call("migrate:refresh");

    $this->call("excel:load", [
        "reader" => "HeadTeacherReader",
        "file" => "excel_files/head_teachers.xlsx"
    ]);

    $this->call("excel:load", [
        "reader" => "CauseReader",
        "file" => "excel_files/causes.xlsx"
    ]);

    foreach (scandir("excel_files/students") as $file) {
        if ($file === "." || $file === "..")
            continue;

        $this->call("excel:load", [
            "reader" => "StudentReader",
            "file" => "excel_files/students/$file"
        ]);
    }

})->describe('Initiate mind app');
