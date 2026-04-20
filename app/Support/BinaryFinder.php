<?php

namespace App\Support;

class BinaryFinder
{
    public static function chrome(): string
    {
        $Windows = 'C:/Program Files/Google/Chrome/Application/chrome.exe';
        $Darwin = '/Applications/Google Chrome.app/Contents/MacOS/Google Chrome';
        $Linux = '/usr/bin/google-chrome';
        $default = 'google-chrome';

        return static::resolve('chrome', compact('Windows', 'Darwin', 'Linux', 'default'), 'path');
    }

    public static function node(): string
    {
        return static::resolve('node', ['Windows' => 'C:/Program Files/nodejs/node.exe', 'default' => 'node']);
    }

    public static function npm(): string
    {
        return static::resolve('npm', ['Windows' => 'C:/Program Files/nodejs/npm.cmd', 'default' => 'npm']);
    }

    private static function resolve(string $key, array $osPaths, string $suffix = 'binary'): string
    {
        $config = "services.binaries.{$key}_{$suffix}";

        return config($config) ?: collect([PHP_OS_FAMILY, 'Darwin', 'Linux', 'default'])->map(fn ($key) => $osPaths[$key] ?? null)->filter()->first() ?? "/usr/local/bin/{$key}";
    }
}
