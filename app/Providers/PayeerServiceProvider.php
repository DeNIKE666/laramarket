<?php

namespace App\Providers;

use App\Services\Payeer\API;
use App\Services\Payeer\Merchant;
use Illuminate\Support\ServiceProvider;

class PayeerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Merchant::class, function($app) {
            return new Merchant($app['config']['Payeer']);
        });

        $this->app->singleton(API::class, function($app) {
            return new API($app['config']['Payeer']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
