<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lesson extends Model
{
    public function getTimeFromAttribute() {
        return \App\Utils::get_today_date(new Carbon($this->attributes["time_from"]));
    }

    public function getTimeUntilAttribute() {
        return \App\Utils::get_today_date(new Carbon($this->attributes["time_until"]));
    }
}
