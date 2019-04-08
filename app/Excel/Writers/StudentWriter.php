<?php

namespace App\Excel\Writers;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class StudentWriter {
    private $users;
    private $fields;

    public function __construct($users, $fields) {
        $this->users = $users;
        $this->fields = $fields;
    }

    public function write() {
        $header = collect($this->fields)->map(function($a) {
            return trans("student.fields.".$a);
        });

        $students = collect($this->users)->map(function($a) {
            return collect($this->fields)->map(function($b) use ($a) {
                return $a[$b];
            })->all();
        });


        $sheet = new Spreadsheet();
        $list = $sheet->getSheet(0);

        $list->fromArray($header->all(), null, 'A1');
        $list->fromArray($students->all(), null, 'A2');

        $list->setAutoFilter($list->calculateWorksheetDimension());
        foreach (range('A', 'Z') as $column) {
            $list->getColumnDimension($column)->setAutoSize(true);
        }

        $file = tempnam(sys_get_temp_dir(), "FOO");
        $writer = IOFactory::createWriter($sheet, 'Xlsx');
        $writer->save($file);

        return $file;
    }
}
