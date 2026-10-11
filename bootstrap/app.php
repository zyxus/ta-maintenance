<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(using: function (): void {
        // A public, stateless page: no session, cookies, auth or database middleware.
        require base_path('routes/web.php');
    })
    ->withMiddleware(function (Middleware $middleware): void {
        // Framework default global middleware only.
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Production errors use Laravel's standard error responses.
    })->create();
