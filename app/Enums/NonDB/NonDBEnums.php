<?php

namespace App\Enums\NonDB;

use BadMethodCallException;

/**
 * @method static array auditLogsStyling()
 * @method static array authenticationStyling()
 * @method static array dashboardStyling()
 * @method static array emailAndPageOTP()
 * @method static array emailNotice()
 * @method static array exceptions()
 * @method static array googleFormsStyling()
 * @method static array listTypeModals()
 * @method static array pageButtonStyling()
 * @method static array paginationStyling()
 * @method static array philippineHolidays()
 * @method static array qrCodeStyling()
 * @method static array reportDownloadDataStyling()
 * @method static array reportFormStyling()
 * @method static array submissionsStyling()
 */
final class NonDBEnums
{
    private function __construct() {}

    public static function __callStatic(mixed $method, $arguments)
    {
        $enumClass = match ($method) {
            'auditLogsStyling' => AuditLogsStyling::class,
            'authenticationStyling' => AuthenticationStyling::class,
            'dashboardStyling' => DashboardStyling::class,
            'emailAndPageOTP' => EmailAndPageOTP::class,
            'emailNotice' => EmailNotice::class,
            'exceptions' => Exceptions::class,
            'googleFormsStyling' => GoogleFormsStyling::class,
            'listTypeModals' => ListTypeModals::class,
            'pageButtonStyling' => PageButtonStyling::class,
            'paginationStyling' => PaginationStyling::class,
            'philippineHolidays' => PhilippineHolidays::class,
            'qrCodeStyling' => QrCodeStyling::class,
            'reportDownloadDataStyling' => ReportDownloadDataStyling::class,
            'reportFormStyling' => ReportFormStyling::class,
            'submissionsStyling' => SubmissionsStyling::class,
            default => throw new BadMethodCallException("Method {$method} does not exist."),
        };

        return $enumClass::toSelectArray();
    }
}
