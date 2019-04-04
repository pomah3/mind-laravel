<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use App\Utils;
use Illuminate\Support\Facades\Hash;

class TeacherReader extends RowReader {
    public function get_title(): string {
        return "Учителя";
    }

    public function getColumns(): array {
        return [
            "family_name:name",
            "given_name:name",
            "father_name:name",
        ];
    }

    public function save(array $arr): void {
        $old_user = User::where("given_name", $arr["given_name"])
                        ->where("family_name", $arr["family_name"])
                        ->where("father_name", $arr["father_name"])
                        ->first();

        if ($old_user != null)
            return;

        $teacher = new User;

        $teacher->given_name = $arr["given_name"];
        $teacher->family_name = $arr["family_name"];
        $teacher->father_name = $arr["father_name"];

        $teacher->type = "teacher";

        $teacher->password = Utils::generate_password();

        $teacher->save();
    }
}
