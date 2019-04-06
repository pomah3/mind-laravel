<?php

namespace App\Policies;

use App\User;
use App\Poll;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy {
    use HandlesAuthorization;

    public function view(User $user, Poll $poll) {
        return $this->vote($user, $poll)
            || $this->see_result($user, $poll);
    }

    public function create(User $user) {
        return $user->has_role("teacher");
    }

    public function update(User $user, Poll $poll) {
        return $user->has_role("teacher");
    }

    public function delete(User $user, Poll $poll) {
        return $user->has_role("teacher");
    }

    public function vote(User $user, Poll $poll) {
        return Role::has_complex_role($user, $poll->access_vote)
            && $poll->till_date >= \Carbon\Carbon::now()
            && (
                $poll->can_revote ||
                $poll->get_user_vote($user) === null
            );
    }

    public function see_result(User $user, Poll $poll) {
        return Role::has_complex_role($user, $poll->access_see_result)
            || $poll->creator_id == $user->id;
    }
}
