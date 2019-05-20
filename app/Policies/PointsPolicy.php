<?php

namespace App\Policies;

use App\Cause;
use App\Role;
use App\Transaction;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointsPolicy
{
    use HandlesAuthorization;

    public function seePoints(User $user, User $user1) {
        return true;
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

    public function removeTransaction(User $user, Transaction $tr) {
        return
            (
                $user->type == "teacher" &&
                $tr->from_id == $user->id
            ) || (
                $user->has_role("zam")
            );
    }

    public function takeOffPoints(User $user) {
        return $user->has_role('admin');
    }
}
