<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use Illuminate\Support\Facades\Hash;

class TeacherReader extends RowReader {
    public function get_title(): string {
        return "Учителя";
    }

    public function getColumns(): array {
        return [
            "num",
            "family_name:name",
            "given_name:name",
            "father_name:name",
        ];
    }

    public function save(array $arr): void {
        $teacher = new User;

        $teacher->given_name = $arr["given_name"];
        $teacher->family_name = $arr["family_name"];
        $teacher->father_name = $arr["father_name"];

        $teacher->type = "teacher";

        $teacher->password = str_random(4);

        $teacher->save();
    }
}
