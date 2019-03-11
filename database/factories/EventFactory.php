<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Event::class, function($faker) {
    $from_date = new \Carbon\Carbon(
        $faker->dateTimeBetween("-1 week", "+1 week")->format('r')
    );
    $till_date = $from_date->copy()->addDay();

    return [
        "author_id" => User::where("type", "teacher")->get()->random()->id,
        "title" => $faker->sentence,
        "description" => $faker->text,

        "from_date" => $from_date,
        "till_date" => $till_date,
    ];
});

$factory->afterCreating(App\Event::class, function($event, $faker) {
    $count = $faker->numberBetween(1, 10);
    $people = $faker->randomElements(
        User::where("type", "student")
            ->get()->map(function($u) {
                return $u->id;
            }),
        $count
    );

    foreach ($people as $id) {
        $event->users()->attach($id);
    }
});
