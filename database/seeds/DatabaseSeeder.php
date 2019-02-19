<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Question::query()->delete();
        factory(App\Question::class, 10)->create();

        App\Poll::query()->delete();
        factory(App\Poll::class, 10)->create();

        App\Banner::query()->delete();
        factory(App\Banner::class, 10)->create();

    }
}
