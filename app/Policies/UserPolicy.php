<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view_password(User $user, User $user1) {
        return $user->has_role("teacher");
    }
}
