<?php

namespace App\Policies;

use App\User;
use App\Poll;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the poll.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function view(User $user, Poll $poll)
    {
        return $this->vote($user, $poll)
            || $this->see_result($user, $poll);
    }

    /**
     * Determine whether the user can create polls.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->has_role("teacher");
    }

    /**
     * Determine whether the user can update the poll.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function update(User $user, Poll $poll)
    {
        return $user->has_role("teacher");
    }

    /**
     * Determine whether the user can delete the poll.
     *
     * @param  \App\User  $user
     * @param  \App\Poll  $poll
     * @return mixed
     */
    public function delete(User $user, Poll $poll)
    {
        return $user->has_role("teacher");
    }

    public function vote(User $user, Poll $poll) {
        return Role::has_complex_role($user, $poll->access_vote)
            && $poll->till_date >= \Carbon\Carbon::now();
    }

    public function see_result(User $user, Poll $poll) {
        return Role::has_complex_role($user, $poll->access_see_result)
            || $poll->creator_id == $user->id;
    }
}
