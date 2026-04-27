<?php

namespace App\Enums\NonDB;

use App\{Contracts\Colorable, Traits\Has\HasValues};

enum AuditLogsStyling: string implements Colorable
{
    use HasValues;

    case CONTAINER_BASE = 'w-full group flex items-center overflow-hidden justify-between pl-3 pr-2 py-2 rounded-xl border-2 transition-all duration-200';
    case CONTAINER_SELECTED = 'bg-emerald-50 border-emerald-300 dark:bg-emerald-900/20 dark:border-emerald-700 cursor-default';
    case CONTAINER_DEFAULT = 'bg-slate-100 border-gray-300 dark:bg-slate-700/50 dark:border-slate-700 hover:border-emerald-400 dark:hover:border-emerald-500';

    case ICON_BASE = 'fas fa-file-lines text-3xl ml-[12px]';
    case ICON_SELECTED = 'text-emerald-600';
    case ICON_DEFAULT = 'text-slate-500';

    case TEXT_BASE = 'font-bold ml-[7.5px] flex justify-start';
    case TEXT_SELECTED = 'text-green-700 dark:text-green-300';
    case TEXT_DEFAULT = 'text-black dark:text-white';

    public const ACTIONS = [
        'view' => ['title' => 'View in Full', 'icon' => 'fas fa-eye', 'color' => 'blue', 'width' => '11rem'],
        'copy_text' => ['title' => 'Copy in Plain Text', 'icon' => 'fas fa-file-lines', 'color' => 'emerald', 'width' => '15rem'],
        'copy_md' => ['title' => 'Copy in Markdown', 'icon' => 'fas fa-file-code', 'color' => 'red', 'width' => '15rem'],
    ];

    public static function loadingTargets(): array
    {
        return [
            'fetchFile' => 'Fetching log file...',
            'downloadFile' => 'Downloading log file...',
            'refreshLogs' => 'Refreshing log data...',
            'filter' => 'Filtering logs...',
            'previousPage' => 'Loading previous page...',
            'nextPage' => 'Loading next page...',
            'gotoPage' => 'Navigating...',
            'perPage' => 'Updating records per page...',
            'sortField' => 'Sorting...',
            'triggerGracefulRefresh' => 'Loading...',
            'checkReloadStatus' => 'Loading...',
            'default' => 'Loading...',
        ];
    }

    public static function getLoadingMessage(?string $action = null): string
    {
        return self::loadingTargets()[$action] ?? self::loadingTargets()['default'];
    }

    public static function getLoggingMessage(): ?string
    {
        $template = 'Only the newest :count :unit are recorded in order to save storage space.';

        $messages = [
            'daily' => str($template)->replace([':count', ':unit'], [7, 'log files']),
            'single' => str($template)->replace([':count', ':unit'], [50, 'logs']),
        ];

        return $messages[config('logging.default')] ?? null;
    }

    public function color(): string
    {
        return match ($this) {
            self::CONTAINER_SELECTED, self::ICON_SELECTED, self::TEXT_SELECTED => 'emerald',
            default => 'slate',
        };
    }

    public static function getActionHoverClass(string $action): string
    {
        $color = self::ACTIONS[$action]['color'] ?? 'slate';

        return "text-{$color}-600 dark:text-{$color}-400";
    }

    public static function getContainerClasses(bool $isSelected): array
    {
        return [self::CONTAINER_BASE->value, $isSelected ? self::CONTAINER_SELECTED->value : self::CONTAINER_DEFAULT->value];
    }

    public static function getIconClasses(bool $isSelected): array
    {
        return [self::ICON_BASE->value, $isSelected ? self::ICON_SELECTED->value : self::ICON_DEFAULT->value];
    }

    public static function getTextClasses(bool $isSelected): array
    {
        return [self::TEXT_BASE->value, $isSelected ? self::TEXT_SELECTED->value : self::TEXT_DEFAULT->value];
    }

    public static function getLevelClasses(string $level): string
    {
        $levelLower = str($level)->lower();

        $color = match ($levelLower->toString()) {
            'success' => 'emerald',
            'info' => 'blue',
            'warning' => 'yellow',
            'error' => 'rose',
            default => 'slate',
        };

        $isWarning = $levelLower->is('warning') ? 'text-black dark:text-gray-300' : "text-white dark:text-{$color}-300";
        $isConcerning = !collect(['info', 'success', 'slate'])->contains($levelLower->toString()) ? 'animate-pulse' : '';

        return "bg-{$color}-500 dark:bg-{$color}-900/40 {$isWarning} {$isConcerning} border-{$color}-300 dark:border-{$color}-800";
    }
    public static function getButtonConfig(string $action): array
    {
        return self::ACTIONS[$action] ?? [];
    }

    public static function getHoverClasses(string $action): string
    {
        return self::getActionHoverClass($action);
    }
}
