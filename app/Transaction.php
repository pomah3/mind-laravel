<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Transaction extends Model {
    public static function of_student(User $user) {
        return Transaction::
            where("to_id", $user->id)->
            orWhere("from_id", $user->id);
    }

    public function cause() {
        return $this->belongsTo(Cause::class);
    }

    public function getToUserAttribute() {
        return User::find($this->to_id);
    }

    public function getFromUserAttribute() {
        return User::find($this->from_id);
    }
}
