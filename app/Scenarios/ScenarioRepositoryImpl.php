<?php

namespace App\Scenarios;

use App\User;
use Illuminate\Support\Facades\DB;

class ScenarioRepositoryImpl implements ScenarioRepository {
	public function get_all() {
		$scs = DB::table("scenarios")->get();
		return $this->parse_collection($scs);
	}

	public function get_all_of(User $user) {
		$scs = DB::table("scenarios")
				 ->where("user_id", $user->id)
				 ->get();
		return $this->parse_collection($scs);
	}

	public function get($id) {
		$sc = DB::table("scenarios")
				->where("id", $id)
				->first();

		return $this->parse($sc);
	}

	public function save($scenario) {
		if ($scenario->id) {
			DB::table("scenarios")
			  ->where("id", $scenario->id)
			  ->update($this->deparse($scenario));
		} else {
			$id = DB::table("scenarios")
			  		->insertGetId(
			  			$this->deparse($scenario)
			  		);

			$scenario->id = $id;
		}
	}

	public function delete($scenario) {
		DB::table("scenarios")->where("id", $scenario->id)->delete();
	}

	private function parse_collection($collection) {
		return $collection->map(function($std) {
			return $this->parse($std);
		});
	}

	private function deparse($sc) {
		return [
			"stage" => $sc->get_stage(),
			"data" => json_encode($sc->get_all_data()),
			"user_id" => $sc->get_user(),
            "type" => $sc->get_name()
		];
	}

	private function parse($std) {
		$s = (new \ReflectionClass($std->type))->newInstance();
		$s->id = $std->id;
		$s->set_stage($std->stage);
		$s->set_all_data(json_decode($std->data, true));
		$s->set_user($std->user_id);

		return $s;
	}
}
