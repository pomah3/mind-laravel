<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    protected $fillable = ["points", "title", "access", "category"];
    protected $hidden = [
        "created_at", "updated_at"
    ];

    protected $casts = [
        "access" => "array"
    ];
}
