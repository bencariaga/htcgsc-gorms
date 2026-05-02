<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SystemController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSystemConfiguration
{
    /**
     * Handle an incoming request and verify the system configuration status.
     */
    public function handle(Request $request, Closure $next): Response
    {
        SystemController::checkAndRefurbish();

        return $next($request);
    }
}
