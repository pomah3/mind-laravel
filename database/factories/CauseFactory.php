<?php

use Faker\Generator as Faker;

$factory->define(App\Cause::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence,
        "points" => $faker->numberBetween(-1000, 1000),
        "access" => ["all"],
        "category" => $faker->word
    ];
});
