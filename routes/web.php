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

/*
Points
*/

Route::get("/points/add", "Points@add_index")
    ->middleware("role:teacher");

Route::post("/points/add", "Points@add")
    ->middleware("role:teacher");

Route::get("/points/{student}", "Points@of_student")
    ->middleware("auth");

Route::get("/points", "Points@mine")
    ->middleware("role:student");


/*
Timetable
*/

Route::get("/timetable", "Timetable@show")
    ->middleware("role:student");

/*
Groups
*/

Route::get("/group/{group}", "Group@get")
    ->middleware("auth");