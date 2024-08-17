<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;
use App\Http\Middleware\DefineTheLanguage;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__  .  '/../routes/web.php',
        commands: __DIR__  .  '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            DefineTheLanguage::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);
    })->create();
