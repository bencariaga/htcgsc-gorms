<?php

namespace App\Sanitizers;

use Illuminate\Support\Carbon;

class DateRangeLimiter
{
    public function handle(mixed $value): string
    {
        $date = Carbon::parse($value);
        $now = Carbon::today();
        $maxDate = $now->copy()->addDays(14);

        if ($date->lt($now)) {
            return $now->format('Y-m-d');
        }

        if ($date->gt($maxDate)) {
            return $maxDate->format('Y-m-d');
        }

        return $date->format('Y-m-d');
    }
}
