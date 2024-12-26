<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Helpers\Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->alias(Cart::class, 'Card');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
