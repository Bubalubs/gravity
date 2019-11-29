<?php

namespace Bubalubs\LaravelGravity;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Bubalubs\LaravelGravity\PageContent;
use Bubalubs\LaravelGravity\Page;

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

        $this->publishes([
            __DIR__ . '/resources/dist' => public_path('vendor/laravel-gravity'),
        ], 'public');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'laravel-gravity');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (Schema::hasTable('page_content')) {
            view()->composer('*', function ($view) {
                $content = PageContent::getPageContent($view->getName());

                if ($content) {
                    $data['content'] = [];

                    foreach ($content as $field => $value) {
                        $data['content'][$field] = $value;
                    }
                    
                    $view->with($data);
                }
            });
            
            view()->composer('laravel-gravity::partials.sidebar', function ($view) {
                $pages = Page::all();

                $view->with(compact('pages'));
            }); 
        }
    }
}
