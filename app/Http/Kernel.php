<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            'with_language'
        ],
        'api' => [
            'web',
            'throttle:60,1'
        ],
        'admin' => [
            'web',
            'auth',
            'throttle',
            'role:admin',
            \App\Http\Middleware\Custom\MakeMenu::class,
        ],
        'organization_manager' => [
            'web',
            'auth',
            'throttle',
            'role:organization_manager|admin',
            \App\Http\Middleware\Custom\MakeMenu::class,
        ],
        'space_manager' => [
            'web',
            'auth',
            'throttle',
            'role:space_manager|organization_manager|admin',
            \App\Http\Middleware\Custom\MakeMenu::class,
        ],
        // Custom Ones
        'with_language' => [
            \App\Http\Middleware\Custom\SetConfiguration::class,
            \App\Http\Middleware\Custom\Locale::class
        ],


    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,

    ];
}
