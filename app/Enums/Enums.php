<?php

namespace App\Enums;

use BadMethodCallException;

/**
 * @method static array accountStatuses()
 * @method static array appointmentStatuses()
 * @method static array appointmentTimes()
 * @method static array dataCategories()
 * @method static array fileOutputFormats()
 * @method static array personTypes()
 * @method static array referralTypes()
 * @method static array suffixes()
 */
final class Enums
{
    private function __construct() {}

    public static function __callStatic(mixed $method, $arguments)
    {
        $enumClass = match ($method) {
            'accountStatuses' => AccountStatus::class,
            'appointmentStatuses' => AppointmentStatus::class,
            'appointmentTimes' => AppointmentTime::class,
            'dataCategories' => DataCategory::class,
            'fileOutputFormats' => FileOutputFormat::class,
            'personTypes' => PersonType::class,
            'referralTypes' => ReferralType::class,
            'suffixes' => PersonSuffix::class,
            default => throw new BadMethodCallException("Method {$method} does not exist."),
        };

        return $enumClass::toSelectArray();
    }
}
