<?php

namespace App\Excel\Readers;

use App\Cause;
use App\Excel\RowReader;
use App\Repositories\GroupRepository;
use App\Services\TransactionService;

class OldPointsReader extends RowReader {
    private $group_repo;
    private $trans_serv;
    private $cause;

    public function __construct()
    {
        $this->group_repo = resolve(GroupRepository::class);
        $this->trans_serv = resolve(TransactionService::class);

        $this->cause = Cause::where("title", "С прошлой четверти")->first();
        if (!$this->cause) {
            $this->cause = Cause::firstOrCreate([
                "points" => 0,
                "title" => "С прошлой четверти",
                "access" => '["not", "all"]',
                "category" => "",
            ]);
        }
    }

    public function get_title(): string {
        return "Баллы с прошлой четверти";
    }

    public function getColumns(): array {
        return [
            "num:int", "group:group", "points:int"
        ];
    }

    public function save(array $arr): void {
        $group = $this->group_repo->get($arr["group"]);
        $points = $arr["points"];

        foreach ($group["users"] as $student) {
            $this->trans_serv->add(
                null,
                $student,
                $this->cause,
                $points
            );
        }
    }
}
