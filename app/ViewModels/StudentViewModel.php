<?php

namespace App\ViewModels;

use App\User;
use Spatie\ViewModels\ViewModel;

class StudentViewModel extends ViewModel {
    public $students;
    public $fields;

    public function __construct($students, $fields) {
        $this->students = $students;
        $this->fields = $fields;
    }
}
