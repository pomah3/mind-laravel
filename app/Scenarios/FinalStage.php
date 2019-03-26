<?php

namespace App\Scenarios;

class FinalStage extends Stage {
	public function __construct(callable $output) {
		parent::__construct(
			[],
			function($sc, $input, $user) {},
			$output
		);
	}

	public function is_final() {
		return true;
	}
}
