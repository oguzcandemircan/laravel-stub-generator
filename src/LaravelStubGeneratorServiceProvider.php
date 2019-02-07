<?php

namespace OguzcanDemircan\LaravelStubGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelStubGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelstubgenerator.php', 'laravelstubgenerator');

        // Register the service the package provides.
        $this->app->singleton('laravelstubgenerator', function ($app) {
            return new Stub;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelstubgenerator'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelstubgenerator.php' => config_path('laravelstubgenerator.php'),
        ], 'laravelstubgenerator.config');
       
        // $this->commands([]);
    }
}
