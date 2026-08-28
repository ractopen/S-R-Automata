<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Validation\Rules\Password::defaults(function () {
            return \Illuminate\Validation\Rules\Password::min(10)
                ->mixedCase()
                ->symbols();
        });

        // Register custom view namespaces for the DDD modules
        \Illuminate\Support\Facades\View::addNamespace('Auth', base_path('app/Modules/Auth/Views'));
        \Illuminate\Support\Facades\View::addNamespace('UserManagement', base_path('app/Modules/UserManagement/Views'));
        \Illuminate\Support\Facades\View::addNamespace('Dashboard', base_path('app/Modules/Dashboard/Views'));
    }
}
