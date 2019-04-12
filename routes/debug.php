<?php

use App\Event;
use App\User;
use Faker\Generator as Faker;

Route::prefix("debug")->group(function() {
    Route::prefix("mails")->group(function() {

        Route::get("update", function() {
            return view("email.update", [
                "version" => "1.0.0"
            ]);
        });

        Route::get("verified", function() {
            return view("email.verified", [
                "user" => User::find(1)
            ]);
        });

        Route::get("verify", function() {
            return view("email.verify", [
                "user" => User::find(1),
                "email" => "3908441@gmail.com"
            ]);
        });

        Route::get("custom", function(Faker $faker) {
            return view("email.custom", [
                "subject" => $faker->sentence,
                "text" => $faker->text
            ]);
        });

        Route::get("digest", function() {
            return view("email.digest", [
                "events" => factory(Event::class, 10)->make()
            ]);
        });

    });
});
