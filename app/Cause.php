<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    protected $hidden = [
        "created_at", "updated_at"
    ];

    protected $casts = [
        "access" => "array"
    ];
}
