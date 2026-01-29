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

        /**
         * Where to redirect GUEST users (not logged in)
         * when they try to access routes protected by "auth".
         */
        $middleware->redirectGuestsTo(function ($request) {
            // Admin area
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // Doctor area
            if ($request->is('doctor') || $request->is('doctor/*')) {
                return route('doctor.login');
            }

            // Default (front)
            return route('front.home');
        });

        /**
         * Where to redirect AUTHENTICATED users
         * when they try to access routes protected by "guest".
         */
        $middleware->redirectUsersTo(function ($request) {
            // If logged as admin
            if (auth('admin')->check()) {
                return route('admin.dashboard');
            }

            // If logged as doctor
            if (auth('doctor')->check()) {
                return route('doctor.dashboard');
            }

            return route('front.home');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();
