<?php

namespace App\Providers;

use Illuminate\Support\{Facades\Blade, Facades\View, ServiceProvider};
use Symfony\Component\Finder\Finder;

class ViewServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $path = app_path('Components');

        if (!is_dir($path)) {
            return;
        }

        $finder = (new Finder)->files()->in($path)->name('*.php');

        foreach ($finder as $file) {
            $relativePath = str($file->getRelativePathname())->replace(['/', '.php'], ['\\', ''])->toString();
            $class = "App\\Components\\{$relativePath}";

            if (!class_exists($class)) {
                continue;
            }

            $alias = str($relativePath)->replace('\\', '.')->explode('.')->map(fn ($segment) => str($segment)->kebab())->implode('.');

            Blade::component($class, $alias);
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
