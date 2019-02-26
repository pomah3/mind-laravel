<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    public function seeIndex(User $user) {
        return $user->has_role("teacher");
    }

    public function see(User $user, User $of_user) {
        return (
                $user->has_role("classruk") &&
                $user->get_role_arg("classruk") == $of_user->get_role_arg("student")
            ) || $user->id == $of_user->id;
    }

    public function set(User $user, User $of_user) {
        return $this->see($user, $of_user);
    }
}
