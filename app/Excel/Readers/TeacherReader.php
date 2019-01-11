<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\User;
use Illuminate\Support\Facades\Hash;

class TeacherReader extends RowReader {
    public static function get_name(): string {
        return "Учителя";
    }

    public static function getColumns(): array {
        return [
            ["num"],
            ["family_name", "name"],
            ["given_name", "name"],
            ["father_name", "name"],
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
    }
}
