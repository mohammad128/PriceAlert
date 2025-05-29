<?php

namespace App\Providers;

use App\Services\EmailServices\EmailService;
use App\Services\EmailServices\EmailServiceInterface;
use App\Services\GoldPrice\GoldPriceService;
use App\Services\GoldPrice\GoldPriceServiceInterface;
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
        $this->app->bind(
            abstract: GoldPriceServiceInterface::class,
            concrete: GoldPriceService::class,
        );
        $this->app->bind(
            abstract: EmailServiceInterface::class,
            concrete: EmailService::class,
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
