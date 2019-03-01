<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\GetsUserProvider;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Facades\Lang;

class ProfileTest extends TestCase {
    use GetsUserProvider;

    /**
     * @dataProvider userProvider
     */
    public function testPage(User $user) {
        $this
           ->actingAs($user)
           ->get("/")
           ->assertStatus(200);
    }

    /**
     * @dataProvider rightTimeProvider
     */
    public function testRightTime($user, $time, $greeting) {
        Carbon::setTestNow($time);

        $this
            ->actingAs($user)
            ->get("/")
            ->assertStatus(200)
            ->assertSeeText($greeting);

        Carbon::setTestNow();
    }

    public function rightTimeProvider() {
        $users = $this->getUsers();
        $times = [
            ["10:47", "profile.greeting.morning"],
            ["14:00", "profile.greeting.day"],
            ["15:30", "profile.greeting.day"],
            ["23:00", "profile.greeting.night"],
            ["1:22", "profile.greeting.night"],
            ["7:00",  "profile.greeting.morning"],
            ["6:00",  "profile.greeting.morning"],
            ["6:17",  "profile.greeting.morning"],
            ["17:09", "profile.greeting.evening"],
        ];

        $ret = [];
        foreach ($users as $user) {
            Lang::setLocale($user->locale);
            foreach ($times as $time) {
                $ret[] = [
                    $user,
                    now()->setTime(...explode(":", $time[0])),
                    trans($time[1])
                ];
            }
        }

        return $ret;
    }
}
