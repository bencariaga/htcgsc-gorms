<?php

namespace App\Support;

class BinaryFinder
{
    public static function chrome(): string
    {
        $Windows = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
        $Darwin = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
        $Linux = '/usr/bin/chromium-browser';
        $default = '/usr/bin/chromium-browser';

        return static::resolve('chrome', compact('Windows', 'Darwin', 'Linux', 'default'), 'path');
    }

    public static function node(): string
    {
        return static::resolve('node', [
            'Windows' => 'C:/Program Files/nodejs/node.exe',
            'Linux' => '/usr/bin/node',
            'default' => '/usr/bin/node',
        ]);
    }

    public static function npm(): string
    {
        return static::resolve('npm', [
            'Windows' => 'C:/Program Files/nodejs/npm.cmd',
            'Linux' => '/usr/bin/npm',
            'default' => '/usr/bin/npm',
        ]);
    }

    private static function resolve(string $key, array $osPaths, string $suffix = 'binary'): string
    {
        $config = "services.binaries.{$key}_{$suffix}";
        $configuredPath = config($config);

        if ($configuredPath && file_exists($configuredPath)) {
            return $configuredPath;
        }

        return $osPaths[PHP_OS_FAMILY] ?? $osPaths['default'] ?? "/usr/bin/{$key}";
    }
}
