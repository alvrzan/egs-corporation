<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // Authenticate Middleware
    // Middleware Authenticate.php
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Biarkan mengarahkan ke halaman login bawaan Laravel
        }
    }
}
