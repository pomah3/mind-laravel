<?php

namespace App\Providers;

use App\Scenarios\ScenarioProvider;
use App\Scenarios\ScenarioProviderImpl;
use App\Scenarios\ScenarioRepository;
use App\Scenarios\ScenarioRepositoryImpl;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class ScenarioServiceProvider extends ServiceProvider {
    public $singletons = [
        ScenarioProvider::class => ScenarioProviderImpl::class,
        ScenarioRepository::class => ScenarioRepositoryImpl::class
    ];

    private function policies() {
        Gate::define("create-scenario", "App\Policies\ScenarioPolicy@create");
        Gate::define("answer-scenario", "App\Policies\ScenarioPolicy@answer");
    }

    public function boot() {
        $this->policies();
    }
}
