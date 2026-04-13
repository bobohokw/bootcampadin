<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // ✅ 1. Tambahkan Alias Middleware Admin
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // ✅ 2. Kecualikan Midtrans Callback dari CSRF (Sangat Penting!)
        $middleware->validateCsrfTokens(except: [
            '/midtrans/callback', // Mengizinkan Midtrans mengirim data POST ke website
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();