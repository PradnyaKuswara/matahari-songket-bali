<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $dataCounter = [
            [
                'value' => 300,
                'valueLabel' => '+',
                'label' => 'Product',
            ],
            [
                'value' => 1000,
                'valueLabel' => '+',
                'label' => 'Reached',
            ],
            [
                'value' => 40,
                'valueLabel' => '+',
                'label' => 'Partner',
            ],
            [
                'value' => 100,
                'valueLabel' => '+',
                'label' => 'Lesson',
            ],
        ];

        Facades\View::composer('pages.home', function (View $view) use ($dataCounter) {
            $view->with('dataCounter', $dataCounter);
        });
    }
}
