<?php

namespace App\Support;

use DateTime;
use DateTimeZone;
use Exception;

class TimeZoneConverter
{
    public static function format(string $timezone): string
    {
        try {
            $dateTime = new DateTime('now', new DateTimeZone($timezone));

            $offsetSeconds = $dateTime->getOffset();

            $hours = (int) ($offsetSeconds / 3600);

            $rawMinutes = ($offsetSeconds % 3600) / 60;

            $minutes = $rawMinutes < 0 ? -$rawMinutes : $rawMinutes;

            $symbol = $offsetSeconds >= 0 ? '+' : '-';

            $absoluteHours = $hours < 0 ? -$hours : $hours;

            return str('UTC')->append($symbol, $absoluteHours, ':', str($minutes)->padLeft(2, '0'));
        } catch (Exception) {
            return 'UTC+0:00';
        }
    }
}
