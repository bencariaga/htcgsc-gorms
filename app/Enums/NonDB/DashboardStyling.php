<?php

namespace App\Enums\NonDB;

enum DashboardStyling: string
{
    case TOTAL_STUDENTS = 'total_students';
    case TOTAL_SUBMISSIONS = 'total_submissions';
    case TODAY_APPOINTMENTS = 'today_appointments';
    case TOTAL_REFERRALS = 'total_referrals';
    case TOTAL_SELF_REFERRERS = 'total_self-referrers';
    case TOTAL_NON_SELF_REFERRERS = 'total_non-self-referrers';

    public function preFormattedLabel(): string
    {
        return match ($this) {
            self::TOTAL_SUBMISSIONS => 'Total Form Submissions',
            self::TODAY_APPOINTMENTS => "Today's Appointments",
            self::TOTAL_SELF_REFERRERS => 'Total Self-Referrers',
            self::TOTAL_NON_SELF_REFERRERS => 'Total Non-Self-Referrers',
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
            self::TOTAL_STUDENTS => 'fas fa-users',
            self::TOTAL_SUBMISSIONS => 'fas fa-clipboard-list',
            self::TODAY_APPOINTMENTS => 'fas fa-calendar-check',
            self::TOTAL_REFERRALS => 'fas fa-user-tag',
            self::TOTAL_SELF_REFERRERS => 'fas fa-user',
            self::TOTAL_NON_SELF_REFERRERS => 'fas fa-user-alt-slash',
        };
    }

    public function iconSize(): string
    {
        return $this === self::TOTAL_SUBMISSIONS ? 'text-[28px] w-[2rem]' : 'text-2xl w-[36px]';
    }

    public function subIcon(): string
    {
        return match ($this) {
            self::TOTAL_SUBMISSIONS => 'fas fa-clock',
            self::TODAY_APPOINTMENTS => 'fas fa-stopwatch',
            default => 'fas fa-arrow-up',
        };
    }

    public function subIconSize(): string
    {
        return $this === self::TODAY_APPOINTMENTS ? 'text-sm' : 'text-xs';
    }

    public function colors(): array
    {
        $color = match ($this) {
            self::TOTAL_STUDENTS, self::TOTAL_REFERRALS => 'indigo',
            self::TOTAL_SUBMISSIONS, self::TOTAL_SELF_REFERRERS => 'stone',
            self::TODAY_APPOINTMENTS, self::TOTAL_NON_SELF_REFERRERS => 'emerald',
        };

        $isStone = $color === 'stone';

        return [
            'icon_bg' => "bg-{$color}-100 dark:bg-{$color}-900/30",
            'icon_border' => $isStone ? 'border-stone-500/30 dark:border-stone-500/50' : "border-{$color}-200 dark:border-{$color}-800",
            'icon_text' => "text-{$color}-600 dark:text-{$color}-400",
            'badge_bg' => "bg-{$color}-100 dark:bg-{$color}-900/30",
            'badge_border' => $isStone ? 'border-stone-500/30 dark:border-stone-500/50' : "border-{$color}-200 dark:border-{$color}-900",
            'badge_text' => "text-{$color}-600 dark:text-{$color}-400",
        ];
    }
}
