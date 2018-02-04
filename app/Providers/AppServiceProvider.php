<?php

namespace App\Providers;

use AJT\Toggl\TogglClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Toggl', function ($app) {
            return TogglClient::factory([
                'api_key' => env('TOGGL_API_KEY'),
                'debug' => env('TOGGL_DEBUG')
            ]);
        });
    }
}
