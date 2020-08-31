<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            //Telescope
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);

            //IDE Helper
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        foreach (glob(app_path() . '/Helpers/*.php') as $file) {
            require_once($file);
        }

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(
            'front.partials.navbar_categories',
            \App\Http\ViewComposers\NavCategoriesComposer::class
        );

//        Schema::defaultStringLength(191);

        $this->app->bind('GuzzleHttp\Client', function () {
            $cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
            return new Client([
                'cookies' => $cookieJar,
            ]);
        });

        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }
}
