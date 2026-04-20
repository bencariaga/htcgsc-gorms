<?php

namespace App\Enums\NonDB;

use App\{Support\HolidayClientCustom, Traits\Has\HasValues};
use Illuminate\Support\Carbon;

enum PhilippineHolidays: string
{
    use HasValues;

    case NEW_YEARS_DAY = "New Year's Day";
    case PEOPLE_POWER_ANNIVERSARY = 'People Power Anniversary';
    case MAUNDY_THURSDAY = 'Maundy Thursday';
    case GOOD_FRIDAY = 'Good Friday';
    case BLACK_SATURDAY = 'Black Saturday';
    case DAY_OF_VALOR = 'The Day of Valor';
    case LABOR_DAY = 'Labor Day';
    case INDEPENDENCE_DAY = 'Independence Day';
    case NINOY_AQUINO_DAY = 'Ninoy Aquino Day';
    case NATIONAL_HEROES_DAY = 'National Heroes Day';
    case ALL_SAINTS_DAY = "All Saints' Day";
    case ALL_SOULS_DAY = "All Souls' Day";
    case BONIFACIO_DAY = 'Bonifacio Day';
    case FEAST_OF_THE_IMMACULATE_CONCEPTION = 'Feast of the Immaculate Conception';
    case CHRISTMAS_EVE = 'Christmas Eve';
    case CHRISTMAS_DAY = 'Christmas Day';
    case RIZAL_DAY = 'Rizal Day';
    case NEW_YEARS_EVE = "New Year's Eve";

    public static function fixedDates(int $year): array
    {
        $config = config('holidays.fixed_dates');
        $holidays = [];

        foreach ($config as $name => $date) {
            if ($name === self::NATIONAL_HEROES_DAY->value) {
                $holidays[$name] = Carbon::parse("{$date} {$year}")->format('Y-m-d');

                continue;
            }

            $holidays[$name] = "{$year}{$date}";
        }

        return $holidays;
    }

    public static function all(int $year): array
    {
        return collect((new HolidayClientCustom)->year($year)->result())->all();
    }
}
