<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Observers\PaymentObserver;

use App\Models\payement;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // payement::observe(PaymentObserver::class);
    }
}
