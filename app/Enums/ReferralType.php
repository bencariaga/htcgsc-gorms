<?php

namespace App\Enums;

use App\{Contracts\Colorable, Traits\Has\HasValues};

enum ReferralType: string implements Colorable
{
    use HasValues;

    case Yourself = 'Yourself';
    case SomeoneElse = 'Someone Else';

    public function label(): string
    {
        return $this === self::Yourself ? 'Themselves' : $this->value;
    }

    public function color(): string
    {
        $color = $this === self::Yourself ? 'emerald' : 'orange';

        return "bg-{$color}-500 dark:bg-{$color}-400";
    }
}
