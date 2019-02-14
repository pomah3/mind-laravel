<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duty extends Model
{
    public function getFromTimeAttribute() {
        return \App\Utils::get_today_date(new Carbon($this->attributes["from_time"]));
    }

    public function getTillTimeAttribute() {
        return \App\Utils::get_today_date(new Carbon($this->attributes["till_time"]));
    }
}
