@props(['status' => null, 'level' => null])

@use('App\Contracts\Colorable')
@use('App\Enums\NonDB\AuditLogsStyling')

@php
    [$label, $classes] = match (true) {
        $level !== null => [str($level)->upper(), AuditLogsStyling::getLevelClasses($level)],
        $status !== null => [
            $status instanceof \BackedEnum ? $status->value : $status,
            $status instanceof Colorable ? $status->color() : 'bg-slate-500 text-white border-slate-600'
        ],
        default => ['Unknown', 'bg-slate-500 text-white border-slate-600 dark:bg-slate-400 dark:text-white dark:border-slate-200'],
    };
@endphp

<span class="px-2 py-1 rounded-md text-xs font-bold uppercase border {{ $classes }}">
    {{ $label }}
</span>
