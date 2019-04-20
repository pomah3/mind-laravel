<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest {
    use UserSelectTrait;

    public function rules() {
        return [
            "title"       => "required",
            "description" => "required",
            "from_date"   => "required|date",
            "till_date"   => "required|date",
            "users.*"     => "required"
        ];
    }
}
