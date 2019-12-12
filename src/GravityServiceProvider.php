<?php

namespace Bubalubs\Gravity;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Gate;
use Bubalubs\Gravity\PageContent;
use Bubalubs\Gravity\Page;
use Spatie\Permission\Models\Permission;

class GravityServiceProvider extends ServiceProvider
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
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Bubalubs\Gravity\Commands\SetUserAdmin::class
            ]);
        }

        $this->publishes([
            __DIR__ . '/config' => config_path(),
            __DIR__ . '/views' => resource_path('views/vendor/gravity')
        ]);

        $this->publishes([
            __DIR__ . '/resources/dist' => public_path('vendor/gravity'),
        ], 'public');

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'gravity');
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        if (Schema::hasTable(config('permission.table_names')['permissions'])) {
            Permission::findOrCreate('access_admin');
            Permission::findOrCreate('edit_page_content_in_admin');
            Permission::findOrCreate('edit_global_content_in_admin');
            Permission::findOrCreate('manage_users_in_admin');
            Permission::findOrCreate('use_tools_in_admin');
        }

        if (Schema::hasTable('page_content')) {
            view()->composer('*', function ($view) {
                $content = PageContent::getPageContent($view->getName());

                if ($content) {
                    $data['content'] = [];

                    foreach ($content as $field => $value) {
                        $data['content'][$field] = $value;
                    }
                }

                $data['globalContent'] = PageContent::getGlobalPageContent();

                $view->with($data);
            });
            
            view()->composer('gravity::partials.sidebar', function ($view) {
                $pages = Page::all();

                $view->with(compact('pages'));
            }); 
        }
    }
}
