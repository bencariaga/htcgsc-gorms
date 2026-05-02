<?php

namespace App\Providers;

use App\Support\VerticalFormatter;
use Illuminate\Support\{Facades\Log, ServiceProvider};

class LoggingServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Log::extend('vertical', function ($app, array $config) {
            $handler = $app['log']->channel($config['handler'] ?? 'daily');

            (new VerticalFormatter)($handler);

            return $handler;
        });
    }
}
