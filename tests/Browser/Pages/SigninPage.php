<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Browser;

class SigninPage extends Page {
    public function url() {
        return '/signin';
    }

    public function assert(Browser $browser) {
        $browser->assertPathIs($this->url());
    }

    public function elements() {
        return [
            '@login' => 'input[name="login"]',
            '@password' => 'input[name="password"]',
            '@enter' => 'input[type="submit"]'
        ];
    }
}
