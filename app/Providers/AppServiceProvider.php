<?php

namespace App\Providers;

use BladeUI\Icons\Factory;
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
    public function boot(Factory $factory): void
    {

        $factory->add('my', [
            'path' => resource_path('svg'),
            'prefix' => 'my'
        ]);

    }
}
