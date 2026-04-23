<?php

namespace App\Support;

class BinaryFinder
{
    public static function chrome(): string
    {
        $Windows = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
        $Darwin = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
        $Linux = '/usr/bin/chromium-browser';
        $default = 'chromium-browser';

        return static::resolve('chrome', compact('Windows', 'Darwin', 'Linux', 'default'), 'path');
    }

    public static function node(): string
    {
        return static::resolve('node', ['Windows' => 'C:/Program Files/nodejs/node.exe', 'Linux' => '/usr/bin/node', 'default' => 'node']);
    }

    public static function npm(): string
    {
        return static::resolve('npm', ['Windows' => 'C:/Program Files/nodejs/npm.cmd', 'Linux' => '/usr/bin/npm', 'default' => 'npm']);
    }

    private static function resolve(string $key, array $osPaths, string $suffix = 'binary'): string
    {
        $config = "services.binaries.{$key}_{$suffix}";

        return config($config) ?: ($osPaths[PHP_OS_FAMILY] ?? $osPaths['default'] ?? "/usr/bin/{$key}");
    }
}
