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

$factory->define(App\Poll::class, function($faker) {
    return [
        "creator_id" => 1,
        "title" => $faker->sentence,
        "content" => $faker->text,
        "variants" => $faker->sentences,
        "till_date" => $faker->dateTimeBetween("-1 week", "+1 week"),
        "access_vote" => ["all"],
        "access_see_result" => ["all"]
    ];
});

$factory->define(App\Banner::class, function($faker) {
    $from_date = $faker->dateTimeBetween("-1 week", "+1 week");
    $till_date = $faker->dateTimeBetween($from_date, "+3 week");


    return [
        "img_path" => collect(["1.png", "2.png"])->random(),
        "link" => $faker->url,
        "alt" => $faker->sentence,

        "from_date" => $from_date,
        "till_date" => $till_date
    ];
});

// $factory->afterCreating(App\Banner::class, function($banner, $faker) {
//     $dir = Storage::disk("public")->path("banners");
//     $img = $faker->image($dir, 3510, 264, false);

//     $banner->img_path = $img;
//     $banner->save();
// });

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
