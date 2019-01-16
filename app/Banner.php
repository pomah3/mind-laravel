<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $dates = [
        "till_date",
        "from_date"
    ];

    protected $guarded = ["img_path"];
}
