<?php

namespace App\Providers;

use Illuminate\{Cache\RateLimiting\Limit, Http\Request};
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\{RateLimiter, Route};

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        RateLimiter::for('api', fn (Request $request) => Limit::perMinute(60)->by($request->user()?->getAuthIdentifier() ?: $request->ip()));

        $this->routes(function () {
            Route::middleware('api')->prefix('api')->group(base_path('routes/api.php'));

            Route::middleware('web')->group(function () {
                $webRoutes = ['web', 'auth', 'livewire', 'miscellaneous'];

                foreach ($webRoutes as $route) {
                    require base_path("routes/{$route}.php");
                }
            });
        });
    }
}
