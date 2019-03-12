<?php

namespace App\Policies;

use App\User;
use App\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Roles;

class BannerPolicy {
    use HandlesAuthorization;

    public function view(User $user) {
        return $user->has_role(Roles::MODERATOR)
            || $user->has_role(Roles::PEDORG);
    }

    public function create(User $user) {
        return $user->has_role(Roles::MODERATOR)
            || $user->has_role(Roles::PEDORG);
    }

    public function update(User $user) {
        return $user->has_role(Roles::MODERATOR)
            || $user->has_role(Roles::PEDORG);
    }

    public function delete(User $user) {
        return $user->has_role(Roles::MODERATOR)
            || $user->has_role(Roles::PEDORG);
    }
}
