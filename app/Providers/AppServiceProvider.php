<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Excel\ReaderProvider;
use Illuminate\Support\Facades\View;

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
