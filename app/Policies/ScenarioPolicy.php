<?php

namespace App\Policies;

use App\Scenarios\Scenario;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ScenarioPolicy {
    use HandlesAuthorization;

    public function create(User $user, Scenario $scenario) {
        return true;
    }

    public function answer(User $user, Scenario $scenario) {
        foreach ($scenario->get_users() as $u) {
            if ($user->id == $u->id)
                return true;
        }

        return false;
    }
}
