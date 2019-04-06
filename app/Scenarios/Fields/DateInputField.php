<?php

namespace App\Scenarios\Fields;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateInputField implements InputField {
    private $name;
    private $label;
    private $value = null;

    public function __construct(string $name, string $label) {
        $this->name = $name;
        $this->label = $label;
    }

    public function get_html() {
        return view("scenario.fields.date", [
            "name" => $this->name,
            "label" => $this->label,
        ]);
    }

    public function set_value(Request $r) {
        $this->value = new Carbon($r->all()[$this->name]);
    }

    public function get_date() {
        return $this->value;
    }
}
