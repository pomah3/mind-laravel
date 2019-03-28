<?php

namespace App\Scenarios;

use App\User;

interface ScenarioRepository {
	public function get_all();
	public function get_all_of(User $user);
	public function get($id);
	public function save(Scenario $scenario);
	public function delete(Scenario $scenario);
}
