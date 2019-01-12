<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use App\Excel\ReaderProvider;

class AppServiceProvider extends ServiceProvider {
    public $singletons = [
        ReaderProvider::class => ReaderProvider::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Schema::defaultStringLength(191);

        View::composer(
            'layout.menu', 'App\Http\View\Composers\MenuComposer'
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {

    }
}
