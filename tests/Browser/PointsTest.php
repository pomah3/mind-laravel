<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Cause;

class PointsTest extends DuskTestCase {
    public function testAddPoints() {
        $this->browse(function (Browser $browser_s, Browser $browser_t) {
            $teacher = factory(User::class)->create([
                "type" => "teacher"
            ]);

            $student = factory(User::class)->create([
                "type" => "student"
            ]);

            $group = "10-4";

            $student->add_role("student", $group);

            $this->assertEquals($student->student()->get_group(), $group);

            $browser_s
                    ->loginAs($student)
                    ->visit('/points')
                    ->assertSee('Баланс')
                    ->assertSee($student->student()->get_balance())
                    ;

            $browser_t
                ->loginAs($teacher)
                ->visit('/points/add')
                ->pause(1000);

            dd($browser_t->element("form")->getAttribute('innerHTML'));

                // ->select("#select-group", $group)
                // ->pause(1000)
                // ->select("#select-student", $student->id)
                // ->select("#select-category")
                // ->pause(1000)
                // ->select("#select-cause")
                // ;


            $cause = $browser_t->value("#select-cause");
            $cause = Cause::find($cause);

            $browser_t->click(".submit");
            $this->assertNotNull($browser_t->element('.alert-success'));

            $this->assertEquals($student->student()->get_balance(), $cause->points);

            $browser_s
                ->visit("/points")
                ->assertSee($cause->title)
                ->assertSee($student->student()->get_balance())
                ;
        });
    }
}
