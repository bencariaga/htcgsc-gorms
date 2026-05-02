<?php

namespace App\Exports\ReportTypes;

use App\Enums\{AccountStatus, PersonType};
use PhpOffice\PhpSpreadsheet\RichText\RichText;

class Users
{
    public static function headings(): array
    {
        return ['Code', 'User Name', 'Email Address (@gmail.com)', 'Phone Number', 'Role', 'Status'];
    }

    public static function map(mixed $item): array
    {
        $email = str($item->person?->email_address ?? '');
        $formalName = $item->person?->formal_name ?? '—';
        $displayName = $formalName;

        if (str($formalName)->contains(',')) {
            $displayName = new RichText;
            $surname = $displayName->createTextRun(str($formalName)->before(',') . ',');
            $surname->getFont()->setBold(true)->setSize(14)->setName('Arial');
            $rest = $displayName->createTextRun(str($formalName)->after(','));
            $rest->getFont()->setSize(14)->setName('Arial');
        }

        $roleValue = $item->person?->type?->value ?? $item->person?->type;
        $role = 'Staff';

        if ($roleValue === PersonType::Administrator->value) {
            $role = new RichText;
            $role->createTextRun('Administrator')->getFont()->setSize(14)->setBold(true)->setName('Arial');
        }

        $statusValue = $item->account_status->value ?? $item->account_status;
        $status = $statusValue;

        if ($statusValue === AccountStatus::Active->value) {
            $status = new RichText;
            $status->createTextRun('Active')->getFont()->setSize(14)->setBold(true)->setName('Arial');
        }

        $id = $item->user_id;
        $userId = str($id)->padLeft(6, '0');

        $username = $email->replace(['@online.htcgsc.edu.ph', '@gmail.com'], '')->toString();
        $phoneNumber = $item->person?->phone_number ? "\0" . $item->person->phone_number : '—';

        return [$userId, $displayName, $username, $phoneNumber, $role, $status];
    }
}
