<?php

namespace App\Exports\ReportTypes;

use App\{Enums\ReferralType, Models\Student};
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class Students
{
    public static function headings(): array
    {
        return ['Code', 'Student Name', 'Email Address (@online.htcgsc.edu.ph)', 'Phone Number', 'Last Referred By', 'Referral Type'];
    }

    public static function map(mixed $item): array
    {
        $email = str($item->person?->email_address ?? '');

        $id = $item->student_id;
        $studentId = str($id)->padLeft(6, '0');

        $name = self::boldSurname($item->person?->formal_name ?? '—');
        $username = $email->replace(['@online.htcgsc.edu.ph', '@gmail.com'], '')->toString();
        $phone = $item->person?->phone_number ? "\0" . $item->person->phone_number : '—';

        $referrer = self::resolveReferrer($item);
        $refValue = $item->referrals()->first()?->appointment?->referral_type->value;
        $status = $refValue;

        if (!$refValue) {
            $status = new RichText;
            $status->createTextRun('Not a referral yet')->getFont()->setSize(14)->setBold(true)->setName('Arial');
        }

        return [$studentId, $name, $username, $phone, $referrer, $status];
    }

    private static function boldSurname(string $name): mixed
    {
        if ($name === '—' || !str_contains($name, ',')) {
            return $name;
        }

        $richText = new RichText;
        $surname = $richText->createTextRun(str($name)->before(',') . ',');
        $surname->getFont()->setBold(true)->setSize(14)->setName('Arial');
        $rest = $richText->createTextRun(str($name)->after(','));
        $rest->getFont()->setSize(14)->setName('Arial');

        return $richText;
    }

    private static function resolveReferrer(Student $student): mixed
    {
        $latestReferral = $student->referrals()->latest()->first();

        if (!$latestReferral || !$latestReferral->appointment) {
            $never = new RichText;
            $never->createTextRun('Never referred before')->getFont()->setSize(14)->setBold(true)->setName('Arial');

            return $never;
        }

        $appointment = $latestReferral->appointment;
        $referrerPerson = ($appointment->referral_type === ReferralType::Yourself) ? $student->person()->first() : $appointment->referrer?->student?->person;

        return self::boldSurname($referrerPerson?->formal_name ?? 'Unknown');
    }
}
