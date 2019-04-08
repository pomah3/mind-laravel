<?php

namespace App\Scenarios;

use App\User;

class ScenarioProviderImpl implements ScenarioProvider {
	private $scenarios = [
		Need_to_get_to_clinic_Scenario::class
	];

	public function get_all_scenarios() {
		$objs = [];
		foreach ($this->scenarios as $class) {
			$rclass = new \ReflectionClass($class);
			$obj = $rclass->newInstance();
			$objs[] = $obj;
		}

		return $objs;
	}

	public function get_scenarios(User $user) {
		return $this->get_all_scenarios();
	}

	public function get_scenario(string $class) {
        if (!collect($this->scenarios)->contains($class))
            return null;

		$rclass = new \ReflectionClass($class);
		$obj = $rclass->newInstance();
		return $obj;
	}
}
