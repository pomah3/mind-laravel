<?php

namespace App\Scenarios\Fields;

use Illuminate\Http\Request;

class SelectInputField implements InputField {
    private $name;
    private $label;
    private $variants;
    private $value = null;

    public function __construct(string $name, string $label, array $variants) {
        $this->name = $name;
        $this->label = $label;
        $this->variants = $variants;
    }

    public function get_html() {
        return view("scenario.fields.select", [
            "name" => $this->name,
            "label" => $this->label,
            "variants" => $this->variants
        ]);
    }

    public function set_value(Request $r) {
        $this->value = $r->all()[$this->name];
    }

    public function get_choice() {
        return $this->value;
    }
}
