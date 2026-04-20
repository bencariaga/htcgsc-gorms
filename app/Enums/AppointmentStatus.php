<?php

namespace App\Enums;

use App\{Contracts\Colorable, Traits\Has\HasValues};

enum AppointmentStatus: string implements Colorable
{
    use HasValues;

    case Scheduled = 'Scheduled';
    case Done = 'Done';
    case Cancelled = 'Cancelled';
    case Missed = 'Missed';

    public function color(): string
    {
        $color = match ($this) {
            self::Scheduled => 'orange-500',
            self::Done => 'blue-500',
            self::Cancelled => 'gray-500',
            self::Missed => 'red-700',
        };

        return "bg-{$color}";
    }
}
