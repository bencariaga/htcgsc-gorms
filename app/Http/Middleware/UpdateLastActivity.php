<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\{Http\Request, Support\Facades\Auth};
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request and update the user's last activity timestamp.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            session(['last_activity_time' => now()->toDateTimeString()]);
        }

        return $next($request);
    }
}
