<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class MindInit extends Command
{
    protected $signature = 'mind:init {admin password} {--seed}';
    protected $description = 'Load excel files and create admin\'s account with login "1" and given password';

    public function handle() {
        $this->call("migrate:fresh");

        $this->info("Creating admin account..");
        $this->create_admin();
        $this->info("Admin account has been created successful");

        $this->load_excel();

        if ($this->option("seed"))
            $this->call("db:seed");
    }

    private function create_admin() {
        $pass = $this->argument("admin password");

        $admin = new User;
        $admin->given_name = "Admin";
        $admin->family_name = "Adminov";
        $admin->father_name = "Adminovich";
        $admin->type = "teacher";
        $admin->password = $pass;
        $admin->save();
        $admin->add_role("admin");
    }

    private function load_excel() {
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

        $this->call("mind:points-reset");
    }
}
