<?php

namespace App\Actions\Data;

use App\Enums\{AccountStatus, AppointmentStatus, DataCategory, NonDB\ReportDownloadDataStyling, PersonType, ReferralType};
use App\Models\{Appointment, Report, Student, User};
use Carbon\CarbonInterface;
use Illuminate\Support\{Carbon, Collection};

class RenderStatisticalData
{
    public function handle(Report $report, DataCategory $category, CarbonInterface $now): array
    {
        return ['grid' => $this->renderGrid($report, $category, $now)->toArray()];
    }

    private function renderGrid(Report $report, DataCategory $category, CarbonInterface $now): Collection
    {
        $grid = collect(['start_date' => 'From', 'end_date' => 'To'])->map(fn ($suffix, $field) => ['label' => "Included Registered<br>{$category->value} {$suffix}", 'value' => Carbon::parse($report->{$field})->format('M. d, Y')])->values();

        match ($category) {
            DataCategory::Users => $this->buildUserGrid($grid, $now),
            DataCategory::Students => $this->buildStudentGrid($grid, $now),
            DataCategory::Appointments => $this->buildAppointmentGrid($grid, $now),
        };

        return $grid->map(function ($item) {
            $base = collect(['icon', 'iconSize', 'colors', 'subtext', 'type'])->mapWithKeys(fn ($key) => [$key => null])->merge($item)->all();

            if ($base['type'] instanceof ReportDownloadDataStyling) {
                $base['icon'] = $base['type']->icon();
                $base['iconSize'] = $base['type']->iconSize();
                $base['colors'] = $base['type']->colors();
                $base['label'] = $base['type']->preFormattedLabel();
            }

            return $base;
        });
    }

    private function buildUserGrid(Collection $grid, CarbonInterface $now): void
    {
        $admin = User::whereHas('person', fn ($q) => $q->where('type', PersonType::Administrator))->with('person')->first();
        $grid->push(['label' => 'Current Administrator', 'value' => $admin?->person->full_name ?? 'N/A']);
        $all = User::query()->toBase()->select('account_status', 'created_at')->get();
        $mapping = ['total' => [null, ReportDownloadDataStyling::TOTAL_EMPLOYEES], 'active' => [AccountStatus::Active->value, ReportDownloadDataStyling::TOTAL_ACTIVE_EMPLOYEES], 'inactive' => [AccountStatus::Inactive->value, ReportDownloadDataStyling::TOTAL_INACTIVE_EMPLOYEES]];
        $this->pushStatsToGrid($grid, $all, $mapping, $now, 'account_status');
    }

    private function buildStudentGrid(Collection $grid, CarbonInterface $now): void
    {
        $all = Student::query()->withCount(['referrals', 'appointments as self_count' => fn ($q) => $q->where('appointments.referral_type', ReferralType::Yourself), 'appointments as non_self_count' => fn ($q) => $q->where('appointments.referral_type', '!=', ReferralType::Yourself)])->get()->map(function ($s) {
            $created_at = $s->created_at;
            $is_referral = $s->referrals_count > 0;
            $is_self = $s->self_count > 0;
            $is_non_self = $s->non_self_count > 0;

            return collect([$created_at, $is_referral, $is_self, $is_non_self])->values()->all();
        });

        $mapping = ['total' => [null, ReportDownloadDataStyling::TOTAL_STUDENTS], 'referrals' => [true, ReportDownloadDataStyling::TOTAL_REFERRALS, 'is_referral'], 'self' => [true, ReportDownloadDataStyling::TOTAL_SELF_REFERRERS, 'is_self'], 'non_self' => [true, ReportDownloadDataStyling::TOTAL_NON_SELF_REFERRERS, 'is_non_self']];
        $this->pushStatsToGrid($grid, $all, $mapping, $now);
    }

    private function buildAppointmentGrid(Collection $grid, CarbonInterface $now): void
    {
        $all = Appointment::query()->toBase()->select('appointment_status', 'created_at')->get();
        $mapping = ['total' => [null, ReportDownloadDataStyling::TOTAL_SUBMISSIONS], 'done' => [AppointmentStatus::Done->value, ReportDownloadDataStyling::DONE_APPOINTMENTS], 'scheduled' => [AppointmentStatus::Scheduled->value, ReportDownloadDataStyling::SCHEDULED_APPOINTMENTS], 'cancelled' => [AppointmentStatus::Cancelled->value, ReportDownloadDataStyling::CANCELLED_APPOINTMENTS]];
        $this->pushStatsToGrid($grid, $all, $mapping, $now, 'appointment_status');
    }

    private function pushStatsToGrid(Collection $grid, Collection $data, array $mapping, CarbonInterface $now, ?string $field = null): void
    {
        foreach ($mapping as $key => $params) {
            [$status, $enum] = $params;
            $searchField = $params[2] ?? $field;
            $filter = fn ($item) => $key === 'total' ? true : data_get($item, $searchField) === $status;
            $currentData = $data->filter($filter);
            $yearlyData = $currentData->filter(fn ($item) => Carbon::parse(data_get($item, 'created_at'))->year === $now->year);
            $grid->push(['type' => $enum, 'value' => (string) $currentData->count(), 'subtext' => $enum->generateSubtext($yearlyData->count())]);
        }
    }
}
