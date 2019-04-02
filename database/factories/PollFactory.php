<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Poll::class, function($faker) {
    return [
        "creator_id" => User::all()->random()->id,
        "title" => $faker->sentence,
        "content" => $faker->text,
        "variants" => $faker->sentences,
        "till_date" => $faker->dateTimeBetween("-1 week", "+1 week"),
        "access_vote" => ["all"],
        "access_see_result" => ["all"],
        "can_revote" => $faker->boolean
    ];
});
