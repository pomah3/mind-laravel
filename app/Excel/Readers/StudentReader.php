<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class StudentReader extends RowReader {
    public static function get_name(): string {
        return "Ученики";
    }

    public static function getColumns(): array {
        return [
            ["num"],
            ["family_name", "name"],
            ["given_name", "name"],
            ["father_name", "name"],
            ["group", "group"]
        ];
    }

    public static function register(array $arr): void {
        $student = new User;

        $student->given_name = $arr["given_name"];
        $student->family_name = $arr["family_name"];
        $student->father_name = $arr["father_name"];

        $student->type = "student";
        $student->password = "123456789";

        $student->save();

        $student->add_role("student", $arr["group"]);
    }
}
