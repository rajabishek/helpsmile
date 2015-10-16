<?php

namespace Helpsmile\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
            'Helpsmile\Repositories\OrganisationRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\OrganisationRepository'
        );

        $this->app->bind(
            'Helpsmile\Repositories\UserRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\UserRepository'
        );

        $this->app->bind(
            'Helpsmile\Repositories\DonorRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\DonorRepository'
        );

        $this->app->bind(
            'Helpsmile\Repositories\DonationRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\DonationRepository'
        );

        $this->app->bind(
            'Helpsmile\Repositories\NotificationRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\NotificationRepository'
        );

        $this->app->bind(
            'Helpsmile\Repositories\WebhookRepositoryInterface',
            'Helpsmile\Repositories\Eloquent\WebhookRepository'
        );
    }
}
