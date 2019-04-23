<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class GivePointsRequest extends FormRequest {
    public function rules() {
        return [
            "student_id" => "required|exists:users,id",
            "points" => "required|numeric|min:1"
        ];
    }

    public function student() {
        return $this->student ?? ($this->student = User::find($this->student_id));
    }

    public function points() {
        return intval(intval($this->points));
    }
}
