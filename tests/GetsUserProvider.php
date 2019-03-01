<?php

namespace Tests;

use App\User;

trait GetsUserProvider {
    public function userProvider() {
        return collect($this->getUsers())->map(function($a) {return [$a];});
    }

    public function getUsers() {
        $this->createApplication();

        $student = factory(User::class)->make([
            "type" => "student",
        ]);

        $teacher = factory(User::class)->make([
            "type" => "teacher",
        ]);

        return [$student, $teacher];
    }
}
