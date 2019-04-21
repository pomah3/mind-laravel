<?php

namespace App;

use App\Http\Controllers\EventController;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Event extends Model implements TimetableItem {
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

    public function get_start() {
        return $this->from_date->copy();
    }

    public function get_end() {
        return $this->till_date->copy();
    }

    public function get_title() {
        return $this->title;
    }

    public function get_url() {
        return URL::action(
            [EventController::class, "show"],
            ["event" => $this]
        );
    }

    public function responsible() {
        return $this->belongsTo(User::class, 'responsible_id');
    }
}
