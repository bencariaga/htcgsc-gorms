@props(['status'])

@use('App\Contracts\Colorable')
@use('Illuminate\Support\Reflector')

@php
    $colorClasses = $status instanceof Colorable ? $status->color() : 'bg-slate-500';
    $color = collect(explode(' ', $colorClasses))->first(fn($c) => str_starts_with($c, 'bg-')) ?? 'bg-slate-500';
    $label = Reflector::isCallable([$status, 'label']) ? $status->label() : ($status instanceof \BackedEnum ? $status->value : $status);
@endphp

<span class="flex items-center gap-[6px]">
    <span class="h-3 w-3 rounded-full {{ $color }}"></span>
    <span class="text-gray-700 dark:text-slate-300 text-sm font-semibold">
        {{ $label }}
    </span>
</span>
