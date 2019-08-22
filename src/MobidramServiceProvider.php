<?php

namespace Studioone\Mobidram;

use Illuminate\Support\ServiceProvider;

class MobidramServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('mobidram', function()
        {
            return new Mobidram;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/routes.php';

        $this->loadViewsFrom(__DIR__ . '/Views', 'mobidram');
    }
}
