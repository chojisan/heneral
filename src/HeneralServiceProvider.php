<?php

namespace Chojisan\Heneral;

use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class HeneralServiceProvider extends ServiceProvider
{
    /**
     * The filters base class name.
     *
     * @var array
     */
    protected $middleware = [
        'Core' => [
            //'permissions'           => 'PermissionMiddleware',
            'auth.backend'            => 'AuthMiddleware',

        ],
    ];

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'takada');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'takada');
        // $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        // $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {

            // Publishing the configuration file.
            $this->publishes([
                __DIR__.'/../config/heneral.php' => config_path('heneral.php'),
            ], 'heneral.config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => base_path('resources/views/vendor/chojisan'),
            ], 'heneral.views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/chojisan'),
            ], 'heneral.views');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/chojisan'),
            ], 'heneral.views');*/

            // Registering package commands.
            // $this->commands([]);
        }

        //load template middleware
        // $router->aliasMiddleware('template', Modules\TemplateManager\Http\Middleware\TemplateLoader::class);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/heneral.php', 'heneral');

        // Register the service package provides.
        $this->app->singleton('heneral', function ($app) {
            return new Heneral;
        });

        $app = $this->app;

        // Register Controllers
        $this->app->make('Chojisan\Heneral\Http\Controllers\AdminPanelController');

    }
}
