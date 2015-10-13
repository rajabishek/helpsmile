<?php

namespace Helpsmile\Providers;

use Illuminate\Support\ServiceProvider;
use Helpsmile\Services\Navigation\Builder;

class NavigationServiceProvider extends ServiceProvider
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
        $this->app['navigation.builder'] = $this->app->share(function ($app) {
            return new Builder($app['config'], $app['auth']);
        });
    }
}
