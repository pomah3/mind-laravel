<?php

namespace App\Policies;

use App\{User, Roles};
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function view_password(User $user, User $user1) {
        return $user->has_role("teacher");
    }

    public function view(User $user) {
        return $user->has_role("admin");
    }

    public function see_roles(User $user, User $user1) {
        return $user->has_role(Roles::ADMIN);
    }

    public function set_roles(User $user, User $user1) {
        return $this->see_roles($user, $user1) &&
               $user->has_role(Roles::ADMIN);
    }

    public function update(User $user, User $user1) {
        return $user->has_role(Roles::ADMIN);
    }
}
