<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Support\ServiceProvider;

class LaravelGravityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/gravity.php' => config_path('gravity.php'),
        ]);
    }
}
