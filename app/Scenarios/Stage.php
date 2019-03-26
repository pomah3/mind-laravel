<?php

namespace App\Scenarios;

class Stage {
	public $handle;
	public $input;
	public $output;

	public function __construct(array $input, callable $handle, callable $output) {
		$this->handle = $handle;
		$this->input = $input;
		$this->output = $output;
		$this->finally = $finally;
	}

	public function is_final() {
		return false;
	}
}
