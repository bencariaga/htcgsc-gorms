<?php

namespace App\Enums\NonDB;

use Illuminate\Support\{Collection, Str};

enum SubmissionsStyling: string
{
    public static function filters(array|Collection $submissions): array
    {
        return collect(['All' => collect($submissions)->count(), 'Yourself' => $selfCount = collect($submissions)->where('referral_type', 'Yourself')->count(), 'Someone Else' => collect($submissions)->count() - $selfCount])->map(fn ($count, $label) => ['label' => $label, 'value' => $label, 'count' => $count])->values()->toArray();
    }

    public static function appointmentDetails(): array
    {
        return [['icon' => 'fa-calendar-alt', 'value' => 'date'], ['icon' => 'fa-clock', 'value' => 'time']];
    }

    public static function referralStates(): array
    {
        $referralHtml = '<strong class="text-[14px]">Self-Referral</strong>';

        $referrerHtml = <<<'HTML'
            <span class="text-[14px]" x-html="`<strong>Referrer:</strong> ${data['Last Name (Referrer)'] || ''}, ${data['First Name (Referrer)'] || ''} ${data['Middle Name (Referrer)'] ? data['Middle Name (Referrer)'].trim().substring(0,1) + '.' : ''}`"></span>
        HTML;

        return [['condition' => "data.referral_type === 'Yourself'", 'content' => $referralHtml], ['condition' => "data.referral_type !== 'Yourself'", 'content' => $referrerHtml]];
    }

    public static function loadingTargets(): array
    {
        $actions = ['fetch', 'download'];
        $types = ['log', 'pdf', 'image'];
        $targets = [];

        foreach ($actions as $type) {
            $targets["{$type}File"] = Str::ucfirst($type) . 'ing log file...';
        }

        foreach ($types as $type) {
            $label = ($type === 'pdf') ? 'PDF' : $type;
            $targets['download' . Str::ucfirst($type)] = "Downloading as {$label} file...";
        }

        return $targets;
    }

    public static function variables(array|Collection $submissions): array
    {
        $methods = ['filters' => [$submissions], 'appointmentDetails' => [], 'referralStates' => [], 'loadingTargets' => []];
        $optionGroups = [];

        foreach ($methods as $method => $args) {
            $optionGroups[$method] = self::$method(...$args);
        }

        return $optionGroups;
    }
}
