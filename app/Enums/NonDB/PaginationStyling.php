<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;

final class PaginationStyling
{
    use HasValues;

    private const DEFAULTS = ['search' => 'w-[20rem]', 'result' => 'min-w-[15rem]', 'open' => 'left-72', 'closed' => 'left-20'];

    private const CONFIG = ['audit-log' => ['search' => 'w-[12.5rem]', 'result' => 'w-[12.5rem]', 'alias' => 'log', 'open' => 'left-[36rem]', 'closed' => 'left-[23rem]']];

    private const SORT_LABELS = ['id_desc' => 'Newest to Oldest', 'id_asc' => 'Oldest to Newest', 'alpha_asc' => 'Alphabetical (A to Z)', 'alpha_desc' => 'Alphabetical (Z to A)'];

    private const FILTERS = [
        'user' => ['label' => 'Users', 'options' => ['Active', 'Inactive']],
        'appointment' => ['label' => 'Appointments', 'options' => ['Scheduled', 'Done', 'Cancelled', 'Missed']],
        'student' => ['label' => 'Students', 'options' => ['Referrals', 'Self-Referrers', 'Non-Self-Referrers']],
        'audit-log' => ['label' => 'Audit Logs', 'options' => ['Success', 'Info', 'Warning', 'Error']],
    ];

    public static function getSortOptions(string $idColumn, string $alphaColumn): array
    {
        $configs = ['id_desc' => [$idColumn, 'desc'], 'id_asc' => [$idColumn, 'asc'], 'alpha_asc' => [$alphaColumn, 'asc'], 'alpha_desc' => [$alphaColumn, 'desc']];

        return collect($configs)->map(fn ($config, $key) => ['field' => $config[0], 'direction' => $config[1], 'label' => self::SORT_LABELS[$key]])->values()->all();
    }

    public static function getConfiguration(?string $type): array
    {
        $config = self::CONFIG[$type] ?? self::DEFAULTS;

        return collect([$config, ['alias' => $config['alias'] ?? ($type ?? 'default')]])->collapse()->all();
    }

    public static function getFilters(?string $type): ?array
    {
        $filters = self::FILTERS[$type] ?? null;

        if ($filters) {
            $filters['options'] = collect($filters['options'])->prepend('All')->all();
        }

        return $filters;
    }

    public static function getLayoutSettings(?string $type): array
    {
        $config = self::getConfiguration($type);

        return ['filters' => self::getFilters($type), 'open' => $config['open'], 'closed' => $config['closed']];
    }

    public static function getSearchWidth(?string $type): string
    {
        return self::getConfiguration($type)['search'];
    }

    public static function getResultWidth(?string $type): string
    {
        return self::getConfiguration($type)['result'];
    }

    public static function getAlias(?string $type): string
    {
        return self::getConfiguration($type)['alias'];
    }

    public static function getRowsPerPageOptions(): array
    {
        return [5, 10, 20, 'all'];
    }
}
