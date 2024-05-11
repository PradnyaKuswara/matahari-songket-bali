<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            \App\Interfaces\ItemCategoryInterface::class,
            \App\Repositories\ItemCategoryRepository::class
        );
        $this->app->bind(
            \App\Interfaces\ProductCategoryInterface::class,
            \App\Repositories\ProductCategoryRepository::class
        );
        $this->app->bind(
            \App\Interfaces\AddressInterface::class,
            \App\Repositories\AddressRepository::class
        );
        $this->app->bind(
            \App\Interfaces\WeaverInterface::class,
            \App\Repositories\WeaverRepository::class
        );
        $this->app->bind(
            \App\Interfaces\CustomerInterface::class,
            \App\Repositories\CustomerRepository::class
        );
        $this->app->bind(
            \App\Interfaces\ItemInterface::class,
            \App\Repositories\ItemRepository::class
        );
        $this->app->bind(
            \App\Interfaces\ProductInterface::class,
            \App\Repositories\ProductRepository::class
        );
        $this->app->bind(
            \App\Interfaces\ProductionInterface::class,
            \App\Repositories\ProductionRepository::class
        );
        $this->app->bind(
            \App\Interfaces\ArticleInterface::class,
            \App\Repositories\ArticleRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
