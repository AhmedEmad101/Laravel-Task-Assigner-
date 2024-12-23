<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;

use App\Models\Subscription;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use App\Models\Team;
use App\Policies\SubscriptionPolicy;
class AuthServiceProvider extends ServiceProvider
{ protected $policies = [
    // Example: App\Models\SomeModel::class => App\Policies\SomeModelPolicy::class
    Subscription::class => SubscriptionPolicy::class
];
    public function register(): void
    {



    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Define Gates
        Gate::define('is-admin', function (User $user) {
            return $user->IsAdmin;
        });
        Gate::define('delete-team', function (User $user, Team $team) {
            return $user->id === $team->Leader->id;
        });


    }
}
