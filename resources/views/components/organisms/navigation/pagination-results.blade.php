@props(['items', 'type'])

@use('App\Enums\NonDB\PaginationStyling')
@use('Illuminate\Pagination\LengthAwarePaginator')
@use('Illuminate\Support\Str')

@php
    $width = PaginationStyling::getResultWidth($type);
    $alias = PaginationStyling::getAlias($type) ?? $type;

    $isPaginator = $items instanceof LengthAwarePaginator;
    $totalCount = $isPaginator ? $items->total() : $items->count();

    $resultLabel = $totalCount == 1 ? $alias : Str::plural($alias);

    if ($isPaginator) {
        $stats = collect(['firstItem', 'lastItem', 'total'])->map(fn($method) => Str::padLeft($items->$method(), 2, '0'));
        $resultText = "{$stats[0]} to {$stats[1]} of {$stats[2]} {$resultLabel}";
    } else {
        $countPadded = Str::padLeft($totalCount, 2, '0');
        $resultText = "Showing {$countPadded} {$resultLabel}";
    }

    $noResults = 'No results';
@endphp

<div {{ $attributes->merge(['class' => "{$width} font-semibold text-base text-gray-700 dark:text-slate-200 tracking-[0.25px] tabular-nums whitespace-nowrap"]) }}>
    @if($totalCount > 0) {{ $resultText }} @else {{ $noResults }} @endif
</div>
