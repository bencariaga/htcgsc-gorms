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
            self::Active => 'bg-green-500',
            self::Inactive => 'bg-red-700',
        };
    }
}
