<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public function getAskerAttribute() {
        return User::find($this->asker_id);
    }

    public function getAnswererAttribute() {
        return User::find($this->answerer_id);
    }
}
