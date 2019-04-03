<?php

namespace App\Scenarios;

use App\Scenarios\Fields\DateInputField;
use App\Scenarios\Fields\TextInputField;
use App\Scenarios\Fields\UserInputField;
use App\User;
use Carbon\Carbon;

class Need_to_get_to_clinic_Scenario extends Scenario {
    public function get_title() {
        return "Нужно в поликлинику";
    }

	public function get_stages() {
		return [
			"init" => $this->init_stage(),
			"find_vospit" => $this->find_vospit_stage(),
			"show_to_student" => $this->show_to_student_stage()
		];
	}

	public function init_stage() {
		return new Stage(
			[
				new DateInputField("when", "Когда тебе в поликлинику")
			],
			function($sc, $input, $user) {
				$sc->set_data("student", $user->id);
				$sc->set_data("when", (string)$input[0]->get_date());
				$sc->set_users([User::find(1)]);
				$sc->set_stage("find_vospit");
			},
			function($sc, $user) {
				return "";
			}
		);
	}

	public function find_vospit_stage() {
		return new Stage(
			[
				new UserInputField("vospit", "Воспитатель, который с ним пойдёт", ["teacher"])
			],
			function($sc, $input, $user) {
				$sc->set_data("vospit", $input[0]->get_user()->id);
				$sc->set_users([User::find($sc->get_data("student"))]);
				$sc->set_stage("show_to_student");
			},
			function($sc, $user) {
				return view("scenario.list.Need_to_get_to_clinic.find_vospit", [
                    "student" => User::find($sc->get_data("student")),
                    "date" => new Carbon($sc->get_data("when"))
                ]);
			}
		);
	}

	public function show_to_student_stage() {
		return new FinalStage(
			function($sc, $user) {
				return view("scenario.list.Need_to_get_to_clinic.show_to_student", [
                    "vospit" => User::find($sc->get_data("vospit")),
                    "date" => new Carbon($sc->get_data("when"))
                ]);
			}
		);
	}
}
