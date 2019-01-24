<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

use Illuminate\Http\Resources\Json\Resource;
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
        Resource::withoutWrapping();
        Schema::defaultStringLength(191);

        Blade::include('layout.user', 'user');
        Blade::component('layout.alert', 'alert');

        View::composer(
            'layout.menu', 'App\Http\View\Composers\MenuComposer'
        );
        View::composer(
            'layout.banners', 'App\Http\View\Composers\BannersComposer'
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
