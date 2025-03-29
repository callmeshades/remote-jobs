<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ScrapingBytes;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->registerFacades();
    }

    private function registerFacades(): void
    {
        $this->app->singleton('scrapingbytes', function() {
            return new ScrapingBytes();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
