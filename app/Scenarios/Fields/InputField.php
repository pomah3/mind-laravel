<?php

namespace App\Scenarios\Fields\InputField;

use Illuminate\Http\Request;

interface InputField {
	public function get_html();
	public function get_name();
	public function set_value(Request $r);
}
