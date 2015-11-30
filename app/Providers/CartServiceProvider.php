<?php

namespace App\Providers;

// use Ecom\Cart\Cart;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Cart', function($app)
        {
            return new Ecom\Cart\Cart($app['session.store']);
        });
    }
}
