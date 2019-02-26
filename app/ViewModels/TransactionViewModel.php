<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class TransactionViewModel extends ViewModel {
    public $student;
    public $transactions;
    public $days;

    public function __construct($student, $transactions) {
        $this->student = $student;
        $this->transactions = $transactions;

        $this->group_by_days();
    }

    private function group_by_days() {
        $d = [];
        foreach ($this->transactions as $t) {
            $day = $t->created_at->format("Y-m-d");
            $d[$day] = $d[$day] ?? [];
            $d[$day][] = $t;
        }

        $dd = [];
        foreach ($d as $day => $trs) {
            $dd[] = [
                "date" => $trs[0]->created_at,
                "transactions" => $trs
            ];
        }

        $this->days = $dd;
    }
}
