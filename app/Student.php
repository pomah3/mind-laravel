<?php

namespace App;

use App\Services\TransactionService;

class Student {
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function get_balance() {
        return resolve(TransactionService::class)->get_balance($this->user);
    }

    public function get_classruk() {
        $role = Role
            ::where("role", "classruk")
            ->where("role_arg", $this->get_group())
            ->first();

        if (!$role)
            return null;

        return User::find($role->user_id);
    }

    public function get_vospit() {
        $role = Role::where("role", "vospit")
                    ->where("role_arg", $this->get_group())
                    ->first();

        if (!$role)
            return null;

        return User::find($role->user_id);
    }

    public function get_group() {
        return $this->user->get_role_arg("student");
    }
}
