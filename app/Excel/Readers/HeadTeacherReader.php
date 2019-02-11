<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class HeadTeacherReader extends RowReader {
    public function get_title(): string {
        return "Классные руководители";
    }

    public function getColumns(): array {
        return [
            "num",
            "family_name:name",
            "given_name:name",
            "father_name:name",
            "group:group"
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

        $teacher->add_role("classruk", $arr["group"]);
    }
}
