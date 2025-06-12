<?php

use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        // api: __DIR__ . '/../routes/api.php',
    )
    ->withMiddleware(function ($middleware) {
        // Registrasi global middleware di sini jika perlu
    })
    ->withExceptions(function ($exceptions) {
        // Exception handler custom di sini jika perlu
    })

    ->create();

$app->withRouteMiddleware([
    'role' => \App\Http\Middleware\RoleMiddleware::class,
]);
