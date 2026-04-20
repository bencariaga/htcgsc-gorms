<?php

namespace App\Http\Controllers;

use App\Console\Commands\{CleanLivewireTemp, DebugbarClear};
use App\{Exceptions\FalsePositiveException, Support\AppKeyChecker};
use Illuminate\Support\Facades\{Artisan, Auth};

class SystemController extends Controller
{
    public static function checkAndRefurbish(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        static::ensureEncryptionIsConfigured();

        return true;
    }

    protected static function ensureEncryptionIsConfigured(): void
    {
        $checker = new AppKeyChecker;

        if (!$checker->handle()) {
            static::refreshSystemCache();

            Artisan::call('env:repair');

            throw new FalsePositiveException('System configuration error. Encryption key was missing or invalid, but the repair command has been executed.');
        }
    }

    protected static function refreshSystemCache(): void
    {
        $cachedConfig = app()->getCachedConfigPath();

        if (file_exists($cachedConfig)) {
            @unlink($cachedConfig);
        }

        $cacheCommands = ['config', 'route', 'view'];

        foreach ($cacheCommands as $cacheCommand) {
            Artisan::call("{$cacheCommand}:cache");
        }

        DebugbarClear::clear();
        CleanLivewireTemp::clear();
    }
}
