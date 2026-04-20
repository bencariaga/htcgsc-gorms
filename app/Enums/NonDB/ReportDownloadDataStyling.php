<?php

namespace App\Enums\NonDB;

enum ReportDownloadDataStyling: string
{
    case TOTAL_STUDENTS = 'total_students';
    case TOTAL_SUBMISSIONS = 'total_submissions';
    case TOTAL_REFERRALS = 'total_referrals';
    case TOTAL_SELF_REFERRERS = 'total_self-referrers';
    case TOTAL_NON_SELF_REFERRERS = 'total_non-self-referrers';
    case TOTAL_ACTIVE_EMPLOYEES = 'total_active_employees';
    case TOTAL_INACTIVE_EMPLOYEES = 'total_inactive_employees';
    case TOTAL_EMPLOYEES = 'total_employees';
    case DONE_APPOINTMENTS = 'done_appointments';
    case SCHEDULED_APPOINTMENTS = 'scheduled_appointments';
    case CANCELLED_APPOINTMENTS = 'cancelled_appointments';

    public function preFormattedLabel(): string
    {
        return match ($this) {
            self::TOTAL_SUBMISSIONS => 'Total Form Submissions',
            self::TOTAL_SELF_REFERRERS => 'Total Self-Referrers',
            self::TOTAL_NON_SELF_REFERRERS => 'Total Non-Self-Referrers',
            self::DONE_APPOINTMENTS => 'Total Appointments Done',
            self::SCHEDULED_APPOINTMENTS => 'Total Appointments Scheduled',
            self::CANCELLED_APPOINTMENTS => 'Total Appointments Cancelled',
            default => str($this->value)->replace(['_', '-'], ' ')->title()->toString(),
        };
    }

    public function label(): string
    {
        return str($this->preFormattedLabel())->lower()->replace(["today's", 'form', 'total'], ["today's ", 'form ', 'total '])->toString();
    }

    public function generateSubtext(int $count): string
    {
        return "{$count} " . str($this->value)->snake('-')->replace('_', ' ')->lower()->plural($count) . ' this year';
    }

    public function icon(): string
    {
        return match ($this) {
            self::TOTAL_STUDENTS, self::TOTAL_EMPLOYEES => 'fa-solid fa-users',
            self::TOTAL_SUBMISSIONS => 'fa-solid fa-clipboard-list',
            self::TOTAL_REFERRALS => 'fa-solid fa-user-tag',
            self::TOTAL_SELF_REFERRERS, self::TOTAL_ACTIVE_EMPLOYEES => 'fa-solid fa-user-check',
            self::TOTAL_NON_SELF_REFERRERS, self::TOTAL_INACTIVE_EMPLOYEES => 'fa-solid fa-user-slash',
            self::DONE_APPOINTMENTS => 'fa-solid fa-check-circle',
            self::SCHEDULED_APPOINTMENTS => 'fa-solid fa-calendar-check',
            self::CANCELLED_APPOINTMENTS => 'fa-solid fa-times-circle',
        };
    }

    public function iconSize(): string
    {
        return $this === self::TOTAL_SUBMISSIONS ? 'font-size: 28px; width: 32px;' : 'font-size: 24px; width: 36px;';
    }

    public function colors(): array
    {
        $colors = match ($this) {
            self::TOTAL_STUDENTS, self::TOTAL_REFERRALS, self::TOTAL_EMPLOYEES => ['bg' => '#4F46E5', 'text' => '#FFFFFF', 'border' => '#4338CA'],
            self::TOTAL_SUBMISSIONS, self::TOTAL_SELF_REFERRERS, self::TOTAL_ACTIVE_EMPLOYEES, self::DONE_APPOINTMENTS => ['bg' => '#059669', 'text' => '#FFFFFF', 'border' => '#047857'],
            self::SCHEDULED_APPOINTMENTS => ['bg' => '#D97706', 'text' => '#FFFFFF', 'border' => '#B45309'],
            default => ['bg' => '#57534E', 'text' => '#FFFFFF', 'border' => '#44403C'],
        };

        return [
            'bg' => $colors['bg'],
            'text' => $colors['text'],
            'icon_bg' => $colors['bg'],
            'icon_border' => $colors['border'],
            'icon_text' => $colors['text'],
            'badge_bg' => $colors['bg'],
            'badge_border' => $colors['border'],
            'badge_text' => $colors['text'],
        ];
    }
}
