<?php

namespace App\Enums;

use App\{Contracts\Colorable, Traits\Has\HasValues};

enum AccountStatus: string implements Colorable
{
    use HasValues;

    case Inactive = 'Inactive';
    case Active = 'Active';

    public function color(): string
    {
        return match ($this) {
            self::Active => 'bg-green-500 text-white border-green-300 dark:bg-green-900/40 dark:text-green-300 dark:border-green-800',
            self::Inactive => 'bg-red-700 text-white border-red-500 dark:bg-red-900/40 dark:text-red-300 dark:border-red-800',
        };
    }
}
