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
        return true;
    }

    public function set(User $user, User $of_user) {
        return $user->has_role("socped");
    }
}
