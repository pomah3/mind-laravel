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
        $cnt = 50;

        App\Question::query()->delete();
        factory(App\Question::class, $cnt)->create();

        App\Poll::query()->delete();
        factory(App\Poll::class, $cnt)->create();

        App\Banner::query()->delete();
        factory(App\Banner::class, $cnt)->create();

        App\Event::query()->delete();
        factory(App\Event::class, $cnt)->create();
    }
}
