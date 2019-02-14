<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    protected $dates = [
        "till_date"
    ];

    protected $casts = [
        "variants" => "array",
        "access_vote" => "array",
        "access_see_result" => "array",
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
        $this->votes()->where("user_id", $user->id)->delete();
        $this->votes()->create([
            "user_id" => $user->id,
            "variant_id" => $var_id
        ]);
    }

    public function unvote(User $user) {
        $this->votes()->where("user_id", $user->id)->delete();
    }

    public function get_user_vote(User $user): ?int {
        $vote = $this->votes->where("user_id", $user->id)->first();

        if ($vote === null)
            return null;

        return $vote->variant_id;
    }
}
