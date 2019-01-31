<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [
        "link"
    ];

    protected $casts = [
        "access" => "array"
    ];

    public function author() {
        return $this->belongsTo(User::class, "author_id");
    }
}
