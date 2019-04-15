<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {
    protected $namespace = 'App\Http\Controllers';

    public function map() {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        if (config("app.debug"))
            $this->mapDebugRoutes();
    }

    protected function mapWebRoutes() {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    protected function mapApiRoutes() {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapDebugRoutes() {
        Route::namespace($this->namespace)
             ->prefix("debug")
             ->group(base_path('routes/debug.php'));
    }
}
