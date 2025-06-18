<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Format as FormatHelper;;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('format', function () {
            return new FormatHelper();
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
