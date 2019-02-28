<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class ProfileTest extends TestCase {
    /**
     * @dataProvider userProvider
     */
    public function testStudent(User $user) {
        $this
           ->actingAs($user)
           ->get("/")
           ->assertStatus(200);
    }

    public function userProvider() {
        $this->createApplication();

        $student = factory(User::class)->make([
            "type" => "student",
        ]);

        $teacher = factory(User::class)->make([
            "type" => "teacher",
        ]);

        return [
            [$student],
            [$teacher]
        ];
    }
}
