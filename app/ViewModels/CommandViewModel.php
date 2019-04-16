<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Symfony\Component\Console\Command\Command;

class CommandViewModel extends ViewModel {
    public $commands;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }



    public function args(Command $c) {
        $def = $c->getDefinition();

        return collect($def->getArguments())->map(function($a) {
            return [
                "name" => $a->getName(),
                "desc" => $a->getDescription() ?: $a->getName()
            ];
        });
    }
}
