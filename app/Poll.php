<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $casts = [
        "variants" => "array"
    ];

    public function votes() {
        return $this->hasMany(Vote::class);
    }

    public function get_variants() {
        $ret = [];

        foreach ($this->variants as $id => $variant) {
            $ret[$id] = [
                "count" => $this->votes->where("variant_id", $id)->count(),
                "value" => $variant
            ];
        }

        return $ret;
    }

    public function vote(User $user, int $var_id) {
        $this->votes->where("user_id", $user->id)->delete();
        $this->votes->create([
            "user_id" => $user->id,
            "variant_id" => $var_id
        ]);
    }
}
