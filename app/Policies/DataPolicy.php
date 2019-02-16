<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Excel\Reader;


class DataPolicy

{
    use HandlesAuthorization;

    public function uploadData(User $user, Reader $reader) {
        return $user->has_role("moderator");
    }

    public function viewData(User $user) {
        return $user->has_role("moderator");
    }
}
