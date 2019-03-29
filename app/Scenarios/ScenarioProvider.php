<?php

namespace App\Scenarios;

use App\User;

interface ScenarioProvider {
	public function get_scenarios(User $user);
}
