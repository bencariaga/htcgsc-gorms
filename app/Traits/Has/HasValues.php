<?php

namespace App\Traits\Has;

use Illuminate\Support\Arr;

trait HasValues
{
    public static function values(): array
    {
        return Arr::pluck(self::cases(), 'value');
    }

    public static function toSelectArray(): array
    {
        return Arr::pluck(self::cases(), 'value', 'value');
    }
}
