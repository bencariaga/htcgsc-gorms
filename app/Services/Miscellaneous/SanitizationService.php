<?php

namespace App\Services\Miscellaneous;

use App\Sanitizers\{AppointmentScheduler, DateRangeLimiter, DuplicateContactDetails, EmailAddressFormat, FuzzyNameMatch, FuzzyProfanityWordMatch, LanguageSanitizer, MatchesCurrentFullName, NameSanitizer, PhoneNumberFormat, ReferralTypeIntegrity};

class SanitizationService
{
    public function sanitizeName(string $value): string
    {
        return (new NameSanitizer)->handle($value);
    }

    public function fuzzyFixName(string $value, string $column = 'full_name'): string
    {
        return (new FuzzyNameMatch($column))->handle($value);
    }

    public function sanitizeEmail(string $value): string
    {
        return (new EmailAddressFormat)->handle($value);
    }

    public function sanitizePhoneNumber(string $value): string
    {
        return (new PhoneNumberFormat)->handle($value);
    }

    public function filterProfanity(string $value): string
    {
        return (new FuzzyProfanityWordMatch)->handle($value);
    }

    public function sanitizeLanguage(string $value): string
    {
        return (new LanguageSanitizer)->handle($value);
    }

    public function limitDateRange(string $value): string
    {
        return (new DateRangeLimiter)->handle($value);
    }

    public function scheduleAppointment(string $date, string $time): array
    {
        return (new AppointmentScheduler($time))->handle($date);
    }

    public function flagDuplicateContact(string $value, string $column): ?string
    {
        return (new DuplicateContactDetails($column))->handle($value);
    }

    public function matchSessionName(string $value): string
    {
        return (new MatchesCurrentFullName)->handle($value);
    }

    public function ensureReferralIntegrity(array $data): array
    {
        return (new ReferralTypeIntegrity)->handle($data);
    }
}
