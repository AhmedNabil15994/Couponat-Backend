<?php

namespace Modules\DeviceToken\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Laravel\Sanctum\Sanctum;
use Modules\DeviceToken\Entities\PersonalAccessToken;

class DeviceTokenServiceProvider extends ServiceProvider
{
    protected $middleware = [
        'DeviceToken' => [
            'last.login'     => 'LastLogin',
        ],
    ];
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddleware($this->app['router']);
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('DeviceToken', 'Database/Migrations'));
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('DeviceToken', 'Config/config.php') => config_path('devicetoken.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('DeviceToken', 'Config/config.php'), 'devicetoken'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/devicetoken');

        $sourcePath = module_path('DeviceToken', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/devicetoken';
        }, \Config::get('view.paths')), [$sourcePath]), 'devicetoken');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/devicetoken');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'devicetoken');
        } else {
            $this->loadTranslationsFrom(module_path('DeviceToken', 'Resources/lang'), 'devicetoken');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('DeviceToken', 'Database/factories'));
        }
    }

    /**
     * Register the filters.
     *
     * @param  Router $router
     * @return void
     */
    public function registerMiddleware(Router $router)
    {
        foreach ($this->middleware as $module => $middlewares) {
            foreach ($middlewares as $name => $middleware) {
                $class = "Modules\\{$module}\\Http\\Middleware\\{$middleware}";

                $router->aliasMiddleware($name, $class);
            }
        }
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
