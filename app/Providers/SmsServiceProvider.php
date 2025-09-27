<?php

namespace App\Providers;

use App\Contracts\SmsProviderInterface;
use App\Services\LogSmsService;
use Illuminate\Log\LogServiceProvider;
use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(SmsProviderInterface::class, LogSmsService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
