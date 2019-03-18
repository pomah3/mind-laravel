<?php
    namespace App\Excel\Readers;

    use \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
    use App\Excel\{Reader, Formatter};
    use App\Lesson;
    use \PhpOffice\PhpSpreadsheet\Cell\Coordinate;

    class PrettyTimetableReader extends Reader {
        private $weekdays = ["Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота"];
        private $t_from = ["8:00", "8:50", "9:40", "10:50", "11:40", "12:35", "13:20", "14:05", "14:15", "14:30", "15:20", "16:40", "17:30"];
        private $t_until = ["8:40", "9:30", "10:20", "11:30", "12:20", "13:15", "14:00", "14:10", "14:20", "15:10", "16:00", "17:20", "18:10"];
        function get_title(): string {
            return "Pretty pасписание";
        }

        function before(): void {
            Lesson::query()->delete();
        }

        private function get_range(string $str): int {
            $arr = explode(':', $str);
            $arr[0] = intval(Coordinate::coordinateFromString($arr[0])[1]);
            $arr[1] = intval(Coordinate::coordinateFromString($arr[1])[1]);
            return $arr[1] - $arr[0] + 1;
        }

        function read(Worksheet $w): array {
            $group = $w->getCellByColumnAndRow(1, 5)->getValue();
            $row_ind = 6;
            $col_ind = 1;
            $lessons = [];

            while ($row_ind != 1500) {
                if ($w->getCellByColumnAndRow($col_ind, $row_ind)->getValue() == null) {
                    if ($w->getCellByColumnAndRow($col_ind, $row_ind)->isInMergeRange())
                        $row_ind += $this->get_range($w->getCellByColumnAndRow($col_ind, $row_ind)->getMergeRange());
                    else
                        $row_ind++;
                    continue;
                }

                $str = $w->getCellByColumnAndRow($col_ind, $row_ind)->getValue();

                if (strlen($str) > 5 && mb_substr($str, 0, 5) == "Класс")
                    $group = $str;

                if ($w->getCellByColumnAndRow($col_ind, $row_ind)->getValue() == "#") {
                    $row_ind = $row_ind + ($w->getCellByColumnAndRow($col_ind, $row_ind)->isInMergeRange() == true ? $this->get_range($w->getCellByColumnAndRow($col_ind, $row_ind)->getMergeRange()) : 1);
                    continue;
                }

                $until = $row_ind + ($w->getCellByColumnAndRow($col_ind, $row_ind)->isInMergeRange() == true ? $this->get_range($w->getCellByColumnAndRow($col_ind, $row_ind)->getMergeRange()) : 1);

                $j = 0;
                $col_ind++;
                while ($j < 6) {
                    if ($w->getCellByColumnAndRow($col_ind, $row_ind)->getValue() == null) {
                        $j++;
                        $col_ind += 2;
                        continue;
                    }

                    $arr = [];

                    for ($i = $row_ind; $i < $until; $i += 2) {
                        $lesson = [];
                        if ($w->getCellByColumnAndRow($col_ind, $i)->getValue() == null)
                            continue;
                        $name = $w->getCellByColumnAndRow($col_ind, $i)->getValue();
                        $teacher = $w->getCellByColumnAndRow($col_ind, $i+1)->getValue();
                        if (in_array($name, $arr))
                            continue;
                        $arr[] = $name;

                        $lesson["teacher"] = $teacher;
                        $lesson["class"] = $group;
                        $lesson["num"] = $w->getCellByColumnAndRow(1, $row_ind)->getValue();
                        $lesson["day"] = $this->weekdays[$j];
                        $lesson["name"] = $name;
                        $lesson["place"] = "";
                        $lesson["time_from"] = $this->t_from[intval($w->getCellByColumnAndRow(1, $row_ind)->getValue()) - 1];
                        $lesson["time_until"] = $this->t_until[intval($w->getCellByColumnAndRow(1, $row_ind)->getValue()) - 1];
                        $lessons[] = $lesson;
                    }

                    $j++;
                    $col_ind += 2;
                }
                $row_ind = $until;
                $col_ind = 1;

            }
            return $lessons;
        }

        function save(array $lesson): void {
            $lesson_ = new Lesson;
            $lesson_->group = Formatter::group($lesson["class"]); // normal string
            $lesson_->number = intval($lesson["num"]); // int
            $lesson_->weekday = Formatter::day($lesson["day"]); // string in engl
            $lesson_->lesson = Formatter::string($lesson["name"]); // string
            $lesson_->cabinet = Formatter::string($lesson["place"]); // string
            $lesson_->time_from = date("Y-m-d ").Formatter::time($lesson["time_from"]).":00"; // string
            $lesson_->time_until = date("Y-m-d ").Formatter::time($lesson["time_until"]).":00"; // string

            preg_match("/([А-Яа-я]{2,})/u", $lesson["teacher"], $family);
            $family = $family[0];

            $teacher = \App\User::where("family_name", $family)->first();
            if ($teacher) {
                $lesson_->teacher_id = $teacher->id;
            }

            $lesson_->save();
        }
    }
?>
