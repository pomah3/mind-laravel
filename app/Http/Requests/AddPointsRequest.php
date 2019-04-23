<?php

namespace App\Http\Requests;

use App\Cause;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class AddPointsRequest extends FormRequest {
    private $student;
    private $cause;

    public function rules() {
        return [
            "student_id" => "required|exists:users,id",
            "cause_id" => "required|exists:causes,id"
        ];
    }

    public function cause() {
        return $this->cause ?? ($this->cause = Cause::find($this->cause_id));
    }

    public function student() {
        return $this->student ?? ($this->student = User::find($this->student_id));
    }
}
