<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\{Cause};

class CauseReader extends RowReader {
    public static function get_name(): string {
        return "Причины начисления баллов";
    }

    public static function getColumns(): array {
        return [
            ["num"],
            ["title", "string"],
            ["points", "int"],
        ];
    }

    public static function register(array $arr): void {
        $cause = new Cause;

        $cause->title = $arr["title"];
        $cause->points = $arr["points"];

        $cause->save();
    }
}
