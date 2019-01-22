<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function poll() {
        return $this->belongsTo(Poll::class);
    }
}
