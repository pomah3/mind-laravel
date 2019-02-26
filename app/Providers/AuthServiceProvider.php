<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Question' => 'App\Policies\QuestionPolicy',
        'App\Banner'   => 'App\Policies\BannerPolicy',
        'App\User'     => 'App\Policies\UserPolicy',
        'App\Poll'     => 'App\Policies\PollPolicy',
        'App\Event'    => 'App\Policies\EventPolicy',
        'App\Document' => 'App\Policies\DocumentPolicy',
    ];

    private function pointsPolicies() {
        Gate::define("receive-points", "App\Policies\PointsPolicy@receivePoints");
        Gate::define("see-points", "App\Policies\PointsPolicy@seePoints");
        Gate::define("add-points", "App\Policies\PointsPolicy@addPoints");
        Gate::define("add-index-points", "App\Policies\PointsPolicy@addPointsIndex");
        Gate::define("give-points", "App\Policies\PointsPolicy@givePoints");
        Gate::define("give-index-points", "App\Policies\PointsPolicy@givePointsIndex");
    }

    private function dataPolicies() {
        Gate::define("view-data", "App\Policies\DataPolicy@viewData");
        Gate::define("upload-data", "App\Policies\DataPolicy@uploadData");
    }

    private function statusPolicies() {
        Gate::define("see-status", "App\Policies\StatusPolicy@see");
        Gate::define("see-status-index", "App\Policies\StatusPolicy@seeIndex");
        Gate::define("set-status", "App\Policies\StatusPolicy@set");
    }

    public function boot()
    {
        $this->registerPolicies();
        $this->pointsPolicies();
        $this->dataPolicies();
        $this->statusPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->has_role("admin"))
                return true;
        });
    }
}
