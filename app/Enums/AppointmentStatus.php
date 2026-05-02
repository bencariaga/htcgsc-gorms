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
        $classes = match ($this) {
            self::Scheduled => 'bg-orange-500 text-white border-orange-300 dark:bg-orange-900/40 dark:text-orange-300 dark:border-orange-800',
            self::Done => 'bg-blue-500 text-white border-blue-300 dark:bg-blue-900/40 dark:text-blue-300 dark:border-blue-800',
            self::Cancelled => 'bg-gray-500 text-white border-gray-300 dark:bg-gray-700/50 dark:text-gray-300 dark:border-gray-600',
            self::Missed => 'bg-red-700 text-white border-red-500 dark:bg-red-900/40 dark:text-red-300 dark:border-red-800',
        };

        return $classes;
    }
}
