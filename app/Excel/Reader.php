<?php
namespace App\Excel;

// use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use \PhpOffice\PhpSpreadsheet\IOFactory;
use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

abstract class Reader {
    public function load(string $file_name): void {
        $this->before();

        $spreadsheet = IOFactory::load($file_name);
        $sheet = $spreadsheet->getSheet(0);

        foreach ($this->read($sheet) as $item) {
            $this->save($item);
        }
    }

    public function before(): void {}
    abstract public function read(Worksheet $w): array;
    abstract public function save(array $w): void;

    abstract public function get_title(): string;
    public function get_name() {
        return (new \ReflectionClass($this))->getShortName();
    }
}
