<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        // Register backend component namespace
        Blade::componentNamespace('App\\View\\Components\\Backend', 'backend');
        Blade::anonymousComponentPath(resource_path('views/backend/components'), 'backend');

        // Register frontend component namespace
        Blade::componentNamespace('App\\View\\Components\\Frontend', 'frontend');
        Blade::anonymousComponentPath(resource_path('views/frontend/components'), 'frontend');
    }
}
