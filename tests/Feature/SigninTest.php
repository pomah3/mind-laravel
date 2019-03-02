<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class SigninTest extends TestCase
{
    public function testPage()
    {
        $response = $this->get('/signin');
        $response->assertStatus(200);
        $response->assertSeeText("Вход");

        $response = $this->actingAs(User::find(1))
                         ->get("/signin");

        $response->assertStatus(302);
    }
}
