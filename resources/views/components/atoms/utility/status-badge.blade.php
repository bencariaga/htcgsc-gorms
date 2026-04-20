@props(['status' => null, 'level' => null])

@use('App\Contracts\Colorable')
@use('App\Enums\NonDB\AuditLogsStyling')
@use('Illuminate\Support\Str')

@php
    [$label, $classes] = match (true) {
        $level !== null => [Str::upper($level), AuditLogsStyling::getLevelClasses($level)],
        $status !== null => [$status instanceof \BackedEnum ? $status->value : $status, $status instanceof Colorable ? $status->color() : 'bg-slate-500 text-white'],
        default => ['Unknown', 'bg-slate-500 text-white border-slate-300 dark:bg-slate-400 dark:text-white dark:border-slate-200'],
    };
@endphp

<span class="px-2 py-1 rounded-md text-xs font-bold uppercase border {{ $classes }}">
    {{ $label }}
</span>
