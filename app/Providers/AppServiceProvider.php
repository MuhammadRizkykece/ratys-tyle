<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

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
    public function boot()
    {
        View::composer('*', function ($view) {

            $cart = session()->get('cart', []);

            $cartCount = 0;

            foreach ($cart as $item) {
                $cartCount += $item['quantity'];
            }


            $view->with('cartCount', $cartCount);
        });
    }
}
