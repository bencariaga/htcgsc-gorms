<?php

namespace App\Traits\Has;

trait HasValues
{
    /** @return array<int, string|int> */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /** @return array<string|int, string|int> */
    public static function toSelectArray(): array
    {
        $values = array_column(self::cases(), 'value');

        return array_combine($values, $values);
    }

    public static function count(): int
    {
        return count(self::cases());
    }
}
