<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Hash;

class HeadTeacherReader extends RowReader {
    public static function get_name(): string {
        return "Классные руководители";
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
        $teacher = new User;

        $teacher->given_name = $arr["given_name"];
        $teacher->family_name = $arr["family_name"];
        $teacher->father_name = $arr["father_name"];

        $teacher->type = "teacher";
        $teacher->password = "123456789";
        $teacher->save();

        $teacher->add_role("classruk", $arr["group"]);
    }
}
