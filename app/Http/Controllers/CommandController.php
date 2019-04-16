<?php

namespace App\Http\Controllers;

use App\ViewModels\CommandViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class CommandController extends Controller {
    private $whitelist = ["mind:"];
    private $blacklist = ["mind:init"];

    public function index() {
        $commands = collect(Artisan::all())->filter(function($command) {
            foreach ($this->blacklist as $b) {
                if (Str::startsWith($command->getName(), $b))
                    return false;
            }

            foreach ($this->whitelist as $w) {
                if (Str::startsWith($command->getName(), $w))
                    return true;
            }
            return false;
        });
        return view("command.index", new CommandViewModel($commands));
    }

    public function execute(Request $request) {

    }
}
