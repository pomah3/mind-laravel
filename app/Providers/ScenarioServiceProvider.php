<?php

namespace App\Providers;

use App\Scenarios\ScenarioProvider;
use App\Scenarios\ScenarioProviderImpl;
use App\Scenarios\ScenarioRepository;
use App\Scenarios\ScenarioRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class ScenarioServiceProvider extends ServiceProvider {
    public $singletons = [
        ScenarioProvider::class => ScenarioProviderImpl::class,
        ScenarioRepository::class => ScenarioRepositoryImpl::class
    ];
}
