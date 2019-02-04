<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Excel\Reader;
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

        Gate::define("upload-data", function(User $user, Reader $reader) {
            return $user->has_role("teacher");
        });
        Gate::define("view-data", function(User $user) {
            return $user->has_role("teacher");
        });

        Gate::before(function ($user, $ability) {
            if ($user->has_role("admin"))
                return true;
        });
    }
}
