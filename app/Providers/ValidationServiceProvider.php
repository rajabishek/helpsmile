<?php

namespace Helpsmile\Providers;

use Illuminate\Support\ServiceProvider;

class ValidationServiceProvider extends ServiceProvider
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
       $this->app->bind(
            'Helpsmile\Services\Validation\FactoryInterface',
            'Helpsmile\Services\Validation\LaravelValidator'
        );
    }
}
