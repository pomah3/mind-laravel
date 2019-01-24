<?php

Route::get('/', "ProfileController@index")
    ->middleware("auth")
    ->name("profile");

Route::get('/signin', "SigninController@index")
    ->middleware("guest")
    ->name("signin");

Route::post("/signin", "SigninController@enter")
    ->middleware("guest");

Route::get("/out", "SigninController@logout")
    ->middleware("auth");

Route::get("/setlocale/{locale}", "LocaleController@set")
    ->middleware("auth");

Route::prefix("/points")->group(function() {
    Route::get("add", "PointsController@add_index")
        ->middleware("role:teacher");

    Route::post("add", "PointsController@add")
        ->middleware("role:teacher");

    Route::get("", "PointsController@mine")
        ->middleware("role:student");

    Route::get("give", "PointsController@give_index");
    Route::post("give", "PointsController@give");

    Route::get("{student}", "PointsController@of_student")
        ->middleware("auth");
});

Route::get("/timetable", "TimetableController@show")
    ->middleware("role:student");

Route::prefix("/groups")->group(function() {
    Route::get("{group}", "GroupController@get")
        ->middleware("auth");

    Route::get("", "GroupController@all")
        ->middleware("auth");
});

Route::prefix("/users")->group(function() {
    Route::get("{user}", "UserController@show")
        ->middleware("auth");
});

Route::prefix("/questions")->middleware("auth")->group(function() {
    Route::get("", "QuestionController@show");
    Route::post("store", "QuestionController@store");
    Route::post("answer/{question}", "QuestionController@answer")
        ->middleware("can:answer,question");
    Route::delete("{question}", "QuestionController@delete")
        ->middleware("can:delete,question");
});

Route::resource("banners", "BannerController")->except([
    "show"
]);

Route::resource("polls", "PollController");

Route::prefix("/polls")->group(function() {
    Route::post("{poll}/vote/{variant_id}", "PollController@vote");
});

Route::prefix("/settings")->middleware("auth")->group(function() {
    Route::get("", "SettingsController@index");
    Route::post("/change_password", "SettingsController@change_password");
});
