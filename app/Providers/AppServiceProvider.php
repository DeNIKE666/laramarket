<?php

namespace App\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\Cookie\SessionCookieJar;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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

        Schema::defaultStringLength(191);

        $this->app->bind('GuzzleHttp\Client', function () {
            $cookieJar = new SessionCookieJar('SESSION_STORAGE', true);
            return new Client([
                'cookies' => $cookieJar,
            ]);
        });
    }
}
