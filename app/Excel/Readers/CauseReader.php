<?php

namespace App\Excel\Readers;

use App\Excel\RowReader;
use App\{Cause};

class CauseReader extends RowReader {
    public function get_title(): string {
        return "Причины начисления баллов";
    }

    public function getColumns(): array {
        return [
            "num:int", "title:string", "points:int", "access:string"
        ];
    }

    public function before(): void {
        Cause::query()->delete();
    }

    public function save(array $arr): void {
        $cause = new Cause;

        $cause->title = $arr["title"];
        $cause->points = $arr["points"];
        $cause->id = $arr["num"];
        $cause->access = json_decode($arr["access"]);

        $cause->save();
    }
}
