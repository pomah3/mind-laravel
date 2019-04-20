<?php

namespace App\ViewModels;

use App\Transaction;
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
                "transactions" => collect($trs)->sortByDesc("created_at")
            ];
        }

        $this->days = collect($dd)->sortByDesc("date");
    }

    public function good_transaction(Transaction $tr) {
        if ($tr->from_id == $this->student->id)
            return false;

        if ($tr->points < 0)
            return false;

        return true;
    }

    public function tr_points(Transaction $tr) {
        $points = abs($tr->points);

        if ($this->good_transaction($tr))
            return "+$points";

        return "-$points";
    }
}
