<?php

namespace App\Scenarios;

use App\Document;
use App\Scenarios\Fields\DateInputField;
use App\Scenarios\Fields\TextInputField;
use App\Scenarios\Fields\UserInputField;
use App\User;
use App\Utils;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class Need_to_get_to_clinic_Scenario extends Scenario {
    public function get_title() {
        return "Нужно в поликлинику";
    }

	public function get_stages() {
		return [
			"init" => $this->init_stage(),
			"find_vospit" => $this->find_vospit_stage(),
			"show" => $this->show_stage()
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
                $sc->set_data("zam", $user->id);

				$sc->set_users([User::find($sc->get_data("student")), $user]);
				$sc->set_stage("show");

                $sc->prepare_order();
			},
			function($sc, $user) {
				return view("scenario.list.Need_to_get_to_clinic.find_vospit", [
                    "student" => User::find($sc->get_data("student")),
                    "date" => new Carbon($sc->get_data("when"))
                ]);
			}
		);
	}

    public function prepare_order() {
        $student = User::find($this->get_data("student"));
        $vospit = User::find($this->get_data("vospit"));
        $zam = User::find($this->get_data("zam"));
        $date = new \Carbon\Carbon($this->get_data("when"));

        $doc = Utils::word_template("word/need_to_clinic.docx", [
            "student" => $student->get_name(),
            "group" => $student->student()->get_group(),
            "zam" => $zam->get_name(),
            "vospit" => $vospit->get_name(),
            "date" => (string) $date
        ]);

        $this->set_data("doc_id", $doc->id);
    }

	public function show_stage() {
		return new FinalStage(
			function($sc, $user) {
                if ($user->type == "student")
                    return $sc->show_to_student();
                else
                    return $sc->show_to_zam();
			}
		);
	}

    private function show_to_student() {
        return view("scenario.list.Need_to_get_to_clinic.show_to_student", [
            "vospit" => User::find($this->get_data("vospit")),
            "date" => new Carbon($this->get_data("when"))
        ]);
    }

    private function show_to_zam() {
        return view("scenario.list.Need_to_get_to_clinic.show_to_zam", [
            "student" => User::find($this->get_data("student")),
            "vospit" => User::find($this->get_data("vospit")),
            "date" => new Carbon($this->get_data("when")),
            "doc" => URL::signedRoute("documents.show", [
                "document" => Document::find($this->get_data("doc_id"))
            ])
        ]);
    }
}
