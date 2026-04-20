<?php

namespace App\Enums;

use BadMethodCallException;

/**
 * @method static array personTypes()
 * @method static array suffixes()
 * @method static array referralTypes()
 * @method static array appointmentStatuses()
 * @method static array appointmentTimes()
 * @method static array accountStatuses()
 */
final class Enums
{
    private function __construct() {}

    public static function __callStatic(mixed $method, $arguments)
    {
        $enumClass = match ($method) {
            'personTypes' => PersonType::class,
            'suffixes' => PersonSuffix::class,
            'referralTypes' => ReferralType::class,
            'appointmentStatuses' => AppointmentStatus::class,
            'appointmentTimes' => AppointmentTime::class,
            'accountStatuses' => AccountStatus::class,
            default => throw new BadMethodCallException("Method {$method} does not exist."),
        };

        return $enumClass::toSelectArray();
    }
}
