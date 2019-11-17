<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Bubalubs\LaravelGravity\PageContent;

class LaravelGravityServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        
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
            __DIR__ . '/views' => resource_path('views/vendor/laravel-gravity')
        ]);

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-gravity');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        
        if (Schema::hasTable('page_content')) {
            view()->composer('*', function ($view) {
                $content = PageContent::getPageContent($view->getName());
                
                $data = [];

                foreach ($content as $key => $value) {
                    $data[$key] = $value;
                }
                
                $view->with($data);
            });
        }
    }
}
