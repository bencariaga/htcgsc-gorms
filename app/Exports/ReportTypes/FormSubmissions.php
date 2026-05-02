<?php

namespace App\Exports\ReportTypes;

use App\Enums\AppointmentStatus;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class FormSubmissions
{
    public static function headings(): array
    {
        return ['Code', 'Referral Name', 'Referrer Name', 'Booked Time', 'Reason', 'Status'];
    }

    public static function map(mixed $item): array
    {
        $rawTime = Carbon::parse($item->appointment_time?->toTwentyFourHour())->format('h:i A') ?? '';
        $datePart = str($item->appointment_date)->replace(['00:00:00', ' '], '') . ' | ';

        $bookedTime = new RichText;
        $bookedTime->createTextRun($datePart)->getFont()->setSize(14)->setName('Arial');
        $bookedTime->createTextRun($rawTime)->getFont()->setSize(14)->setBold(true)->setName('Arial');

        $statusValue = $item->appointment_status->value ?? $item->appointment_status;
        $status = $statusValue;

        if ($statusValue !== AppointmentStatus::Done->value) {
            $status = new RichText;
            $status->createTextRun($statusValue)->getFont()->setSize(14)->setBold(true)->setName('Arial');
        }

        $id = $item->appointment_id;
        $appointmentId = str($id)->padLeft(6, '0');

        $studentName = self::boldSurname($item->referral?->student?->person?->formal_name ?? '—');
        $referrerName = self::boldSurname($item->referrer?->student?->person?->formal_name ?? '—');

        $reason = str($item->reason)->finish('.');

        return compact('appointmentId', 'studentName', 'referrerName', 'bookedTime', 'reason', 'status');
    }

    private static function boldSurname(string $name): mixed
    {
        if ($name === '—' || !str($name)->contains(',')) {
            return $name;
        }

        $richText = new RichText;
        $richText->createTextRun(str($name)->before(',') . ',')->getFont()->setBold(true)->setSize(14)->setName('Arial');
        $richText->createTextRun(str($name)->after(','))->getFont()->setSize(14)->setName('Arial');

        return $richText;
    }
}
