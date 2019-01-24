<?php

namespace App\Policies;

use App\User;
use App\Question;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function answer(User $user) {
        return $user->has_role("teacher");
    }

    public function delete(User $user, Question $question) {
        return $user->id == $question->asker_id ||
               $user->has_role("teacher");
    }
}
