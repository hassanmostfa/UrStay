<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
              // Check the guard to determine which login page to redirect to
            if ($request->expectsJson()) {
                return null;
            }

            if ($request->is('api/*') && !$request->user()) {
                return route('not.auth');
            }

            if ($request->is('admin/*')) {
                return route('admin-login');
            }

            if ($request->is('supervisor/*')) {
                return route('supervisor.login');
            }

            if ($request->is('owner/*')) {
                return route('owner.login');
            }

            // Default to the normal user login
            return route('user-login');
        }
}
