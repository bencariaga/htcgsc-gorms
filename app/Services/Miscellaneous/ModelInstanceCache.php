<?php

namespace App\Services\Miscellaneous;

use Illuminate\Database\Eloquent\Model;

class ModelInstanceCache
{
    protected static array $cache = [];

    public static function get(string $class, int|string $id)
    {
        return self::$cache[$class][$id] ?? null;
    }

    public static function set(string $class, int|string $id, Model $instance): void
    {
        self::$cache[$class][$id] = $instance;
    }

    public static function clear(?string $class = null): void
    {
        if ($class) {
            unset(self::$cache[$class]);

            return;
        }

        self::$cache = [];
    }
}
