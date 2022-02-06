<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Cart\DatabaseRepository;
use App\Repositories\Cart\CartRepository;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('cart.cookie_id', function () {
            $cookie_id = Cookie::get('cart_id');
            if (!$cookie_id) {
                $cookie_id = Str::uuid();
                Cookie::queue('cart_id', $cookie_id, 60 * 60 * 24 * 365);
            }

            return $cookie_id;
        });

        $this->app->bind(CartRepository::class, function () {
            return new DatabaseRepository(app()->make('cart.cookie_id'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
        Paginator::defaultView('paginations.index');
    }
}
