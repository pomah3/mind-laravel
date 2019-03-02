<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\Browser\Pages\SigninPage;

use App\User;

class SigninTest extends DuskTestCase {
    public function testPage() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertPathIs('/signin');
        });
    }

    public function testRightPassword() {
        $user = factory(User::class)->create([
            "password" => 123
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new SigninPage)
                    ->type("@login", $user->id)
                    ->type("@password", $user->password)
                    ->press("@enter")
                    ->assertPathIs("/")
                    ->assertSee($user->given_name);
        });
    }

    public function testWrongPassword() {
        $user = factory(User::class)->create([
            "password" => 1234,
            "locale" => "ru"
        ]);


        $this->browse(function ($browser) use ($user) {
            $browser->visit(new SigninPage)
                    ->type("@login", $user->id)
                    ->type("@password", $user->password . "1")
                    ->press("@enter")
                    ->assertSee("Неправильный");
        });
    }
}
