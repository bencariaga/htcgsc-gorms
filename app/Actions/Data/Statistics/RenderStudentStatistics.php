<?php

namespace App\Actions\Data\Statistics;

use App\{Traits\Handles\HandlesStatistics, Models\Student};
use App\Enums\{NonDB\ReportDownloadDataStyling, ReferralType};
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class RenderStudentStatistics
{
    use HandlesStatistics;

    public function handle(Collection $grid, CarbonInterface $now): void
    {
        $all = Student::query()->withCount([
            'referrals',
            'appointments as self_count' => fn ($q) => $q->where('appointments.referral_type', ReferralType::Yourself),
            'appointments as non_self_count' => fn ($q) => $q->where('appointments.referral_type', '!=', ReferralType::Yourself),
        ])->get()->map(fn ($stats) => ['created_at' => $stats->created_at, 'is_referral' => $stats->referrals_count > 0, 'is_self' => $stats->self_count > 0, 'is_non_self' => $stats->non_self_count > 0]);

        $mapping = [
            'total' => [null, ReportDownloadDataStyling::TOTAL_STUDENTS],
            'referrals' => [true, ReportDownloadDataStyling::TOTAL_REFERRALS, 'is_referral'],
            'self' => [true, ReportDownloadDataStyling::TOTAL_SELF_REFERRERS, 'is_self'],
            'non_self' => [true, ReportDownloadDataStyling::TOTAL_NON_SELF_REFERRERS, 'is_non_self'],
        ];

        $this->pushStatsToGrid($grid, collect($all), $mapping, $now);
    }
}
