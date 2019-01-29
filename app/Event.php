<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $dates = [
        "till_date",
        "from_date"
    ];

    protected $guarded = [];

    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }

    public function users() {
        return $this->belongsToMany(User::class);
    }
}
