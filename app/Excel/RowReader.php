<?php

namespace App\Excel;

abstract class RowReader extends Reader {
	abstract public static function getColumns(): array;
	abstract public static function register(array $arr): void;

	public static function handle(\Closure $f) {
		foreach (static::process($f) as $arr) {
			static::register($arr);
		}
	}

	public static function process(\Closure $f): array {
		$i = 1;

		$arr = [];

		while($f(0, $i) != "") {
			$obj = [];

			$j = 0;
			foreach (static::getColumns() as $column) {
				$val = $f($j, $i);

				if (isset($column[1]))
					$val = call_user_func(Formatter::class."::".$column[1], $val);

				$obj[$column[0]] = $val;
				$j++;
			}

			$arr[] = $obj;
			$i++;
		}

		return $arr;
	}
}
