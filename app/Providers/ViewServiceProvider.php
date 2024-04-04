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
                'value' => 400,
                'valueLabel' => 'K+',
                'label' => 'Lesson',
            ],
            [
                'value' => 200,
                'valueLabel' => 'K+',
                'label' => 'Lesson',
            ],
            [
                'value' => 70,
                'valueLabel' => 'K+',
                'label' => 'Lesson',
            ],
            [
                'value' => 2000,
                'valueLabel' => 'K+',
                'label' => 'Lesson',
            ],
        ];

        Facades\View::composer('pages.home', function (View $view) use ($dataCounter) {
            $view->with('dataCounter', $dataCounter);
        });
    }
}
