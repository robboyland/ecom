<?php

namespace App\Providers;

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
        $this->app->bind('Ecom\Repository\Order\OrderInterface',
                 'Ecom\Repository\Order\EloquentOrderRepository');

        $this->app->bind('Ecom\Billing\BillingInterface',
                         'Ecom\Billing\StripeBilling');
    }
}
