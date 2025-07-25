<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\CheckRole;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan route middleware di sini
        $middleware->alias([
            'auth' => Authenticate::class,
            'auth.user' => CheckRole::class . ':user',
            'auth.admin' => CheckRole::class . ':admin',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
