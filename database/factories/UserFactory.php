<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(User::class, function($faker) {
    $g = $faker->randomElement(["male", "female"]);
    return [
        "given_name" => $faker->firstName($g),
        "family_name" => $faker->lastName($g),
        "father_name" => $faker->middleName($g),

        "type" => $faker->randomElement(["teacher", "student"]),
        "password" => "123",
    ];
});

$factory->afterCreating(User::class, function($user, $faker) {
    if ($user->type != "student")
        return;

    $group = $faker->numberBetween(6, 10) ."-". $faker->numberBetween(1, 6);
    $user->add_role("student", $group);
});
