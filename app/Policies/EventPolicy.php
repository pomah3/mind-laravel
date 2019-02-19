<?php

namespace App\Policies;

use App\User;
use App\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Event $event) {
        return $event->author_id == $user->id
            || $event->users->contains($user);
    }

    public function create(User $user) {
        return $user->has_role("teacher");
    }

    public function update(User $user, Event $event) {
        //
    }

    public function delete(User $user, Event $event) {
        //
    }

    public function restore(User $user, Event $event) {
        //
    }

    public function forceDelete(User $user, Event $event) {
        //
    }
}
