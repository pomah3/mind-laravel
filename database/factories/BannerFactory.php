<?php

use Faker\Generator as Faker;

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
