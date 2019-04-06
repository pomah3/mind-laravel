<?php

namespace App\Scenarios\Fields;

use Illuminate\Http\Request;

interface InputField {
	public function get_html();
	public function set_value(Request $r);
}
