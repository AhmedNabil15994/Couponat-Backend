<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Modules\Core\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    protected $module_name = 'Notification';

    protected $frontend_routes = [
        'routes.php',
    ];

    protected $dashboard_routes = [
        'routes.php',
        'notifications.php',
    ];

    protected $trainer_routes = [
        'routes.php',
        'notifications.php',
    ];

    protected $api_routes = [
        'routes.php',
    ];

    protected function frontendGroups()
    {
        return [
            'middleware' => config('core.route-middleware.frontend.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.frontend')
        ];
    }

    protected function dashboardGroups()
    {
        return [
            'middleware' => config('core.route-middleware.dashboard.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.dashboard')
        ];
    }

    protected function trainerGroups()
    {

        return [
            'middleware' => config('core.route-middleware.trainer.auth'),
            'prefix' => LaravelLocalization::setLocale() . config('core.route-prefix.trainer')
        ];
    }

    protected function apiGroups()
    {
        return [
            'middleware' => config('core.route-middleware.api.guest'),
            'prefix' => config('core.route-prefix.api')
        ];
    }
}
