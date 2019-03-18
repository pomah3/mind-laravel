<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Repositories\TimetableRepository;

class TimetablePolicy {
    use HandlesAuthorization;

    private $ttr;

    public function __construct(TimetableRepository $ttr) {
        $this->ttr = $ttr;
    }

    public function see(User $user) {
        return $this->ttr->has_lessons($user);
    }
}
