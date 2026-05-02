<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\{Http\Request, Support\Carbon, Support\Facades\Auth};
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request and redirect authenticated users or expire inactive sessions.
     */
    public const HOME = '/dashboard';

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = collect($guards ?: [null]);

        foreach ($guards as $guard) {
            if (!Auth::guard($guard)->check()) {
                continue;
            }

            $lastActivity = session('last_activity_time');
            $isExpired = $lastActivity && Carbon::parse($lastActivity)->diffInMinutes(now()) >= 30;

            if ($isExpired) {
                Auth::guard($guard)->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return $next($request);
            }

            return redirect(self::HOME);
        }

        return $next($request);
    }
}
