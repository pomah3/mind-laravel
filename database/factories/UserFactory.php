<?php

use Faker\Generator as Faker;

$factory->define(App\User::class, function($faker) {
    $g = $faker->randomElement(["male", "female"]);
    return [
        "given_name" => $faker->firstName($g),
        "family_name" => $faker->lastName($g),
        "father_name" => $faker->middleName($g),

        "type" => $faker->randomElement(["teacher", "student"]),
        "password" => "123"
    ];
});
