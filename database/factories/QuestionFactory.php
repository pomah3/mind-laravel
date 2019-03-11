<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Question::class, function($faker) {
    if ($faker->boolean()) {
        return [
            "asker_id" => User::all()->random()->id,
            "question" => $faker->text
        ];
    }

    return [
        "asker_id" => User::all()->random()->id,
        "question" => $faker->text,
        "answerer_id" => User::all()->random()->id,
        "answer" => $faker->text,
        "answered_at" => $faker->dateTime(),
        "created_at" => $faker->dateTime()
    ];
});
