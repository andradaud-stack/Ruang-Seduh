<?php

use App\Http\Middleware\AuthorizeRequest;
use App\Http\Middleware\EnsureCustomerIsAuthenticated;
use App\Http\Middleware\RedirectIfCustomerIsAuthenticated;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__.'/../routes/web.php',
            __DIR__.'/../routes/customer.php',
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->web(append: [
            AuthorizeRequest::class,
        ]);

        $middleware->alias([
            'customer.auth' => EnsureCustomerIsAuthenticated::class,
            'customer.guest' => RedirectIfCustomerIsAuthenticated::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();

if (isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || env('VERCEL') || env('APP_STORAGE')) {
    $app->useStoragePath(env('APP_STORAGE', '/tmp/storage'));
}

return $app;
