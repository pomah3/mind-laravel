<?php

namespace App\Scenarios;

class ScenarioProviderImpl implements ScenarioProvider {
	private $scenarios = [
		Need_to_get_to_clinic_Scenario::class
	]; 

	public function get_scenarios() {
		$objs = [];
		foreach ($this->scenarios as $class) {
			$rclass = new \ReflectionClass($class);
			$obj = $rclass->newInstance();
			$objs[] = $obj;
		}

		return $objs;
	}
}
