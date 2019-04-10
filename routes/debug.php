<?php

use App\User;

Route::prefix("debug")->group(function() {
    Route::prefix("mails")->group(function() {

        Route::get("update", function() {
            return view("email.update", [
                "news" => [
                    "Добавили почту",
                    "Добавили баллы",
                    "Добавили фигню",
                    "Обновили баги"
                ]
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

        Route::get("custom", function() {
            return view("email.custom", [
                "subject" => "Поздравляем!",
                "text" => "Дорогие учителя и ученики! Команда Mind поздравляет вас с НГ и желает счастья-здоровья"
            ]);
        });

    });
});
