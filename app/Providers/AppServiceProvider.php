<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

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
        View::composer('*', function ($view) {

            $cartCount = 0;

            if(auth()->check()){
                $cartCount = Cart::where('user_id',auth()->id())->count();
            }

            $view->with('globalCartCount',$cartCount);
        });
    }
}
