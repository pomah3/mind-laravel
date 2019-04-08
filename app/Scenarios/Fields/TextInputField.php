<?php

namespace App\Scenarios\Fields;

use Illuminate\Http\Request;

class TextInputField implements InputField {
	private $name;
	private $label;
	private $text = null;

	public function __construct(string $name, $label) {
		$this->name = $name;
		$this->label = $label;
	}

	public function get_html() {
		return view("scenario.fields.text", [
            "label" => $this->label,
            "name" => $this->name
        ]);
	}

	public function set_value(Request $r) {
		$this->text = $r->all()[$this->name];
	}

	public function get_text() {
		return $this->text;
	}
}
