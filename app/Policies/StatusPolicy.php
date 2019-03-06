<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Roles;

class StatusPolicy
{
    use HandlesAuthorization;

    public function seeIndex(User $user) {
        return $user->has_role(Roles::SOCPED);
    }

    public function see(User $user, User $of_user) {
        return $user->has_role(Roles::SOCPED);
    }

    public function set(User $user, User $of_user) {
        return $user->has_role(Roles::SOCPED);
    }
}
