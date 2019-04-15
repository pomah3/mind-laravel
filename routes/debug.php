<?php

use App\Event;
use App\Mail\CustomMail;
use App\Mail\UpdateMail;
use App\Mail\VerifiedMail;
use App\Mail\VerifyMail;
use App\User;
use Faker\Generator as Faker;

Route::prefix("mails")->group(function() {

    Route::get("update", function() {
        return new UpdateMail("1.0.0");
    });

    Route::get("verified", function() {
        $user = factory(User::class)->make();

        return new VerifiedMail($user);
    });

    Route::get("verify", function() {
        $user = factory(User::class)->make();

        return new VerifyMail($user);
    });

    Route::get("custom", function(Faker $faker) {
        return new CustomMail(
            $faker->sentence,
            $faker->text
        );
    });

    Route::get("digest", function() {
        return view("email.digest", [
            "events" => factory(Event::class, 10)->make()
        ]);
    });

});
