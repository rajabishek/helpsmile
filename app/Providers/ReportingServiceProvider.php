<?php

namespace Helpsmile\Providers;

use Illuminate\Support\ServiceProvider;

class ReportingServiceProvider extends ServiceProvider
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
        $this->registerManager();

        $this->app->singleton('excelreportgenerator', function () {
            return $this->app['filereportgenerator']->format('excel');
        });
    }

    /**
     * Register the file report generator manager.
     *
     * @return void
     */
    protected function registerManager()
    {
        $this->app->singleton('filereportgenerator', function () {
            return new FileReportGeneratorManager($this->app);
        });
    }
}
