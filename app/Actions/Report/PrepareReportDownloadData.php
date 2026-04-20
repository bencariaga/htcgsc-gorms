<?php

namespace App\Actions\Report;

use App\{Enums\DataCategory, Models\Appointment, Models\Student, Models\User};
use Illuminate\Database\Eloquent\Builder;

class PrepareReportDownloadData
{
    public function handle(DataCategory|string $category): Builder
    {
        $dataCategory = $category instanceof DataCategory ? $category : DataCategory::from($category);

        return match ($dataCategory) {
            DataCategory::Users => User::with('person'),
            DataCategory::Students => Student::with(['person', 'referrals.appointment.referrer.person', 'referrals.appointment.person']),
            DataCategory::Appointments => Appointment::with(['person', 'referrer.person']),
        };
    }
}
