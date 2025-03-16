<?php

namespace App\Providers;





use Illuminate\Support\ServiceProvider;

use App\Http\Interfaces\Auth\AuthInterface;
use App\Http\Services\Auth\AuthService;


use App\Http\Interfaces\BuyerInterface;
use App\Http\Services\BuyerService;


use App\Http\Interfaces\SupplierInterface;
use App\Http\Services\SupplierService;

use App\Http\Interfaces\ProductInterface;
use App\Http\Services\ProductService;

 use App\Http\Interfaces\OrderInterface;
 use App\Http\Services\OrderService;

 use App\Http\Interfaces\CartInterface;
 use App\Http\Services\CartService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthInterface::class, AuthService::class);
        $this->app->bind(BuyerInterface::class, BuyerService::class);
        $this->app->bind(SupplierInterface::class, SupplierService::class);
        $this->app->bind(ProductInterface::class, ProductService::class);
        $this->app->bind(OrderInterface::class, OrderService::class);
        $this->app->bind(CartInterface::class, CartService::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
