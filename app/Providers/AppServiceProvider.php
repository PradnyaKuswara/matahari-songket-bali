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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
