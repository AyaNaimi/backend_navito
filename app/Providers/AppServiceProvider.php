<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use App\Services\PriceEstimationService;
use App\Services\TranslationService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TranslationService::class, function () {
            return new TranslationService();
        });

        $this->app->singleton(PriceEstimationService::class, function () {
            return new PriceEstimationService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
            Schema::defaultStringLength(191);

    }
}
