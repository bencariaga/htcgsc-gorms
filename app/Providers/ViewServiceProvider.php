<?php

namespace App\Providers;

use Illuminate\Support\{Facades\Blade, Facades\View, ServiceProvider};

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $components = ['TableRow' => 'organisms.tables.table-row', 'NoticeEmail' => 'layouts.notice-email', 'OTPEmail' => 'layouts.otp-email', 'OTPPage' => 'layouts.otp-page'];

        foreach ($components as $class => $alias) {
            Blade::component("App\\Components\\{$class}", $alias);
        }

        View::composer('profile', fn ($view) => $view->with('user', auth()->user()));

        View::share(['status' => 'Active', 'theme' => 'dark']);

        View::composer('*', function ($view) {
            if (!View::shared('bladeViewName')) {
                View::share('bladeViewName', $view->getName());
            }
        });
    }
}
