<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{ protected $policies = [
    // Example: App\Models\SomeModel::class => App\Policies\SomeModelPolicy::class
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
    }
}
