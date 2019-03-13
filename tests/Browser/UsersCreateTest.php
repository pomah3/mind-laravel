<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCreateTest extends DuskTestCase {
    public function testPage() {
        $user = factory(\App\User::class)->create([
            "type" => "teacher"
        ]);
        $user->add_role("admin");

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit("/users/create")
                ->assertSee("Добавить пользователя")
                ;
        });
    }

    public function testUserCreate() {
        $user = factory(\App\User::class)->create([
            "type" => "teacher"
        ]);
        $user->add_role("admin");

        $this->browse(function (Browser $browser) use ($user) {
            $browser
                ->loginAs($user)
                ->visit("/users/create")
                ->type("family_name", "Иванов")
                ->type("given_name", "Иван")
                ->type("father_name", "Иванович")
                ->select("type", "Ученик")
                ->type("group", "10-4")
                ->click(".submit")
                ;

            $browser
                ->assertSee("Иванов")
                ->assertSee("10-4")
                ;
        });
    }
}
