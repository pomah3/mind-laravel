<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class StudentReader extends RowReader {
    public function get_title(): string {
        return "Ученики";
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
        $student = new User;

        $student->given_name = $arr["given_name"];
        $student->family_name = $arr["family_name"];
        $student->father_name = $arr["father_name"];

        $student->type = "student";
        $student->password = str_random(4);

        $student->save();

        if ($arr["group"] == null || $arr["group"] == "")
            throw new Exception("Group is empty", 1);

        $student->add_role("student", $arr["group"]);
    }
}
