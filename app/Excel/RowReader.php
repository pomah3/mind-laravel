<?php

namespace App\Excel;

use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;

abstract class RowReader extends Reader {
    abstract public function getColumns(): array;

    public function read($sheet): array {
        $arr = [];

        $last_row = $sheet->getHighestRow();
        $last_row = intval($last_row);


        for ($i=2; $i <= $last_row; $i++) {
            $obj = [];
            $j = 1;

            if (($sheet->getCellByColumnAndRow($j, $i)->getValue() ?? "") == "")
                break;

            foreach ($this->getColumns() as $column) {
                $column = explode(":", $column);

                $val = $sheet->getCellByColumnAndRow($j, $i)->getValue();
                $val = $val ?? "";

                if (isset($column[1]))
                    $val = call_user_func(Formatter::class."::".$column[1], $val);

                $obj[$column[0]] = $val;
                $j++;
            }

            $arr[] = $obj;
        }

        return $arr;
    }
}
