<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    protected $dates = [
        "time_from", "time_until"
    ];
}
