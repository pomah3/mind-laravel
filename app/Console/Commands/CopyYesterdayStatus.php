<?php

namespace App\Console\Commands;

use App\Repositories\StatusRepository;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class CopyYesterdayStatus extends Command {
    private $status_repo;

    protected $signature = 'mind:copy-statuses';
    protected $description = 'Copy yesterdays student statuses to today';

    public function __construct(StatusRepository $status_repo) {
        parent::__construct();
        $this->status_repo = $status_repo;
    }

    public function handle() {
        $day = Carbon::yesterday();

        foreach (User::students()->get() as $student) {
            $status = $this->status_repo->get_status_by_day($student, $day);

            if ($status->title != $this->status_repo->get_unknown_status())
                $this->status_repo->set_status_title($student, $status->title);
        }
    }
}
