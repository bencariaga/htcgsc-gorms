<?php

namespace App\Enums;

use App\{Contracts\Colorable, Traits\Has\HasValues};

enum PersonType: string implements Colorable
{
    use HasValues;

    case Administrator = 'Administrator';
    case Employee = 'Employee';
    case Student = 'Student';

    public function color(): string
    {
        $color = $this->isAdmin() ? 'orange' : 'emerald';

        return "bg-{$color}-200 dark:bg-{$color}-900/40 text-{$color}-800 dark:text-{$color}-300 border-{$color}-300 dark:border-{$color}-800";
    }

    public function isAdmin(): bool
    {
        return $this === self::Administrator;
    }
}
