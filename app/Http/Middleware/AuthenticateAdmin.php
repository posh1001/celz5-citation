<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) {
            return redirect($this->redirectTo($request));
        }

        return $next($request);
    }

    /**
     * Determine where to redirect users if not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Check if the request is for admin routes
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('welcome'); // redirect to admin login
            }
            // Default login route for normal users
            return route('admin.login');
        }
    }
}
