<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use AfricasTalking\SDK\AfricasTalking;

class AfricaTalkingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->singleton('africastalking', function ($app) {
            $username = config('services.at.username');
            $apiKey = config('services.at.api_key');

            return new AfricasTalking($username, $apiKey);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
