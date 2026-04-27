<?php

namespace App\Traits\Has;

trait HasValues
{
    /** @return array<int, string|int> */
    public static function values(): array
    {
        return collect(self::cases())->pluck('value')->all();
    }

    /** @return array<string|int, string|int> */
    public static function toSelectArray(): array
    {
        return collect(self::cases())->pluck('value', 'value')->all();
    }
}
