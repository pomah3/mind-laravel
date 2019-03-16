<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Browser\Pages\SigninPage;
use App\User;

class SigninTest extends DuskTestCase {
    // use DatabaseTransactions;

    public function testPage() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/');
            $browser->assertPathIs('/signin');
        });
    }

    public function testRightPassword() {
        $user = User::all()->random();

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
        $user = User::all()->random();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new SigninPage)
                    ->type("@login", $user->id)
                    ->type("@password", $user->password . "1")
                    ->press("@enter")
                    ->assertSee("Неправильный");
        });
    }

    public function testViaEmailRight() {
        $user = User::all()->random();
        $user->email = "example@example.com";
        $user->save();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new SigninPage)
                    ->type("@login", $user->email)
                    ->type("@password", $user->password)
                    ->press("@enter")
                    ->assertPathIs("/")
                    ->assertSee($user->given_name);
        });
    }

    public function testViaEmailWrong() {
        $user = User::all()->random();
        $user->email = "example@example.com";
        $user->save();

        $this->browse(function ($browser) use ($user) {
            $browser->visit(new SigninPage)
                    ->type("@login", $user->email)
                    ->type("@password", $user->password . "1")
                    ->press("@enter")
                    ->assertSee("Неправильный");
        });
    }
}
