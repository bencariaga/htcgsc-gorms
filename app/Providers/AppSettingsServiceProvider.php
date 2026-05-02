<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Support\{Facades\Date, Facades\URL, ServiceProvider};

class AppSettingsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Date::use(CarbonImmutable::class);

        $host = request()->header('Host');

        $isRender = str($host)->contains('onrender.com');
        $isNgrok = str($host)->contains('ngrok-free.dev');

        if ($isRender || $isNgrok || request()->header('X-Forwarded-Proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}
