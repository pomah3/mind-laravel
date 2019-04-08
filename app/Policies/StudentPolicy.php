<?php

namespace App\Policies;

use App\Roles;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StudentPolicy {
    use HandlesAuthorization;

    public function seeList(User $user) {
        return $user->has_role(Roles::DIRIC) || $user->has_role(Roles::ZAM);
    }
}
