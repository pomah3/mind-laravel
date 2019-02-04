<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class MindInit extends Command
{
    protected $signature = 'mind:init {admin password}';
    protected $description = 'Load excel files and create admin\'s account with login "1" and given password';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $pass = $this->argument("admin password");

        $this->call("migrate:refresh");

        $admin = new User;
        $admin->given_name = "Admin";
        $admin->family_name = "Adminov";
        $admin->father_name = "Adminovich";
        $admin->type = "teacher";
        $admin->password = $pass;
        $admin->save();
        $admin->add_role("admin");

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
    }
}
