<?php

namespace App\Providers;

use App\Services\PriceAlert\PriceAlertService;
use App\Services\PriceAlert\PriceAlertServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            abstract: PriceAlertServiceInterface::class,
            concrete: PriceAlertService::class,
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
