<?php

namespace App\Policies;

use App\User;
use App\Cause;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointsPolicy
{
    use HandlesAuthorization;

    public function seePoints(User $user, User $user1) {
        return $user->id == $user1->id ||
               $user->type == "teacher";
    }

    public function receivePoints(User $user) {
        return $user->type == "student";
    }

    public function addPoints(User $user, User $to_user, Cause $cause) {
        return $user->type == "teacher"
            && $this->receivePoints($to_user)
            && Role::has_complex_role($user, $cause->access);
    }

    public function addPointsIndex(User $user) {
        return $user->type == "teacher";
    }

    public function givePoints(User $user, User $to_user) {
        return $user->type == "student" && $to_user->type == "student" &&
               $user->id != $to_user->id;
    }

    public function givePointsIndex(User $user) {
        return $user->type == "student";
    }
}
