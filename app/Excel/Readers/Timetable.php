<?php
	namespace App\Excel\Readers;

	use App\Excel\{Reader, Formatter};
	use App\Lesson;

	class Timetable extends Reader {
		static function get_name(): string {
			return "Расписание";
		}

		static function handle(\Closure $f) {
			foreach (static::process($f) as $lesson) {
				static::add_lesson($lesson);
			}
		}

		static function process(\Closure $f): array {
			$lessons = [];
			$c = $f(0, 0);
			$mx = 30;
			for ($i = 1; $i <= $mx; $i += 5) {
				$denek = $f($i, 0);
				if ($denek == "")
					break;
				for ($j = 2; $j <= $mx; $j++) {
					if ($f($i+1, $j) == "")
						break;
					$arr = [];
					$arr["class"] = Formatter::group($c);
					$arr["day"] = Formatter::day($denek);
					$arr["num"] = intval($f(0, $j));
					$arr["name"] = $f($i, $j);
					$arr["place"] = $f($i + 2, $j);
					$arr["teacher"] = Formatter::abbr_name($f($i + 1, $j));
					$arr["time_from"] = trim($f($i + 3, $j));
					$arr["time_until"] = trim($f($i + 4, $j));
					$lessons[] = $arr;
				}
			}
			return $lessons;
		}

		static function add_lesson($lesson) {
			$lesson_ = new Lesson;
			$lesson_->group = $lesson["class"];
			$lesson_->number = $lesson["num"];
			$lesson_->weekday = $lesson["day"];
			$lesson_->lesson = $lesson["name"];
			$lesson_->cabinet = $lesson["place"];
			$lesson_->time_from = $lesson["time_from"];
			$lesson_->time_until = $lesson["time_until"];

			$lesson_->save();
		}
	}
?>