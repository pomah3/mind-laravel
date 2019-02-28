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

    static protected function boot() {
        parent::boot();

        static::deleting(function($banner) {
            Storage::disk("public")->delete("banners/".$banner->img_path);
        });
    }
}
