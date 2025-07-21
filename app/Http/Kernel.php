<?php

namespace App\Http;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Foundation\Application; // Ajoutez ceci
use Illuminate\Routing\Router;


class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     */
    protected $middleware = [
        // Exemple : \App\Http\Middleware\TrustProxies::class,
        // \Fruitcake\Cors\HandleCors::class,
        // \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // \App\Http\Middleware\TrimStrings::class,
        // \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    ];

    protected function terminateMiddleware($request, $response)
{
    /* dd($this->middleware, $this->routeMiddleware, 'terminateMiddleware appelé'); */
    parent::terminateMiddleware($request, $response);
}

    public function __construct(Application $app, Router $router)
    {

        parent::__construct($app, $router);
    }
}
