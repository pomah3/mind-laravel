<?php

Route::get('/', "Profile@index")
    ->middleware("auth")
    ->name("profile");

Route::get('/signin', "Signin@index")
    ->middleware("guest")
    ->name("signin");

Route::post("/signin", "Signin@enter")
    ->middleware("guest");

Route::get("/out", "Signin@logout")
    ->middleware("auth");

Route::get("/setlocale/{locale}", "SetLocale@set")
    ->middleware("auth");

Route::prefix("/points")->group(function() {
    Route::get("add", "Points@add_index")
        ->middleware("role:teacher");

    Route::post("add", "Points@add")
        ->middleware("role:teacher");

    Route::get("{student}", "Points@of_student")
        ->middleware("auth");

    Route::get("", "Points@mine")
        ->middleware("role:student");
});

Route::get("/timetable", "Timetable@show")
    ->middleware("role:student");

Route::prefix("/groups")->group(function() {
    Route::get("{group}", "Group@get")
        ->middleware("auth");

    Route::get("", "Group@all")
        ->middleware("auth");
});

Route::prefix("/users")->group(function() {
    Route::get("{user}", "User@show")
        ->middleware("auth");
});

Route::prefix("/questions")->middleware("auth")->group(function() {
    Route::get("", "Question@show");
    Route::post("store", "Question@store");
    Route::post("answer", "Question@answer");
});
