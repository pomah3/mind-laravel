<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\Banner'   => 'App\Policies\BannerPolicy',
        'App\User'     => 'App\Policies\UserPolicy',
        'App\Poll'     => 'App\Policies\PollPolicy',
        'App\Event'    => 'App\Policies\EventPolicy',
        'App\Document' => 'App\Policies\DocumentPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define("view-data", "App\Policies\DataPolicy@viewData");
        Gate::define("upload-data", "App\Policies\DataPolicy@uploadData");

        Gate::define("receive-points", "App\Policies\PointsPolicy@receivePoints");
        Gate::define("add-points", "App\Policies\PointsPolicy@addPoints");
        Gate::define("add-points-index", "App\Policies\PointsPolicy@addPointsIndex");
        Gate::define("give-points", "App\Policies\PointsPolicy@givePoints");
        Gate::define("give-points-index", "App\Policies\PointsPolicy@givePointsIndex");

        Gate::before(function ($user, $ability) {
            if ($user->has_role("admin"))
                return true;
        });
    }
}
