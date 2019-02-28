<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SigninTest extends TestCase {
    public function testBasicTest() {
        $response = $this->get('/signin');
        $response->assertStatus(200);
    }
}
