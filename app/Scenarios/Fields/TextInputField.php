<?php

namespace App\Scenarios\Fields;

use Illuminate\Http\Request;

class TextInputField {
	private $name;
	private $label;
	private $text = null;

	public function __construct(string $name, $label) {
		$this->name = $name;
		$this->label = $label;
	}

	public function get_html() {
		return $this->label . ': <input type="text" required name="'.$this->name.'">';
	}

	public function set_value(Request $r) {
		$this->text = $r->all()[$this->name];
	}

	public function get_text() {
		return $this->text;
	}
}
