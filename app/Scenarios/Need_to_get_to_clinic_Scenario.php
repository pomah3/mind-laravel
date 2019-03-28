<?php

namespace App\Scenarios;

use App\Scenarios\Fields\InputField\TextInputField;
use App\User;

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
				new TextInputField("when", "Когда тебе в поликлинику")
			],
			function($sc, $input, $user) {
				$sc->set_data("student", $user);
				$sc->set_data("when", $input[0]->get_text());
				$sc->set_user("1");
				$sc->set_stage("find_vospit");
			},
			function($sc) {
				return "";
			}
		);
	}

	public function find_vospit_stage() {
		return new Stage(
			[
				new TextInputField("vospit", "Воспитатель, который с ним пойдёт")
			],
			function($sc, $input, $user) {
				$sc->set_data("vospit", $input[0]->get_text());
				$sc->set_user($sc->get_data("student"));
				$sc->set_stage("show_to_student");
			},
			function($sc) {
				$s = User::find($sc->get_data("student"));
				return "Ученик ". $s->get_name() . " хочет в поликлинику";
			}
		);
	}

	public function show_to_student_stage() {
		return new FinalStage(
			function($sc) {
				return "Тебе нашли воспета: " . $sc->get_data("vospit");
			}
		);
	}
}
