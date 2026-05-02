<?php

namespace App\Providers;

use App\Services\Miscellaneous\TextBeeService;
use BeyondCode\QueryDetector\QueryDetectorServiceProvider;
use Illuminate\Support\{Reflector, ServiceProvider};

/** @property mixed $app */
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(TextBeeService::class, fn () => new TextBeeService);

        if ($this->app->environment('local') && Reflector::isCallable(QueryDetectorServiceProvider::class)) {
            $this->app->register(QueryDetectorServiceProvider::class);
        }
    }

    public function boot(): void
    {
        error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);
    }
}
