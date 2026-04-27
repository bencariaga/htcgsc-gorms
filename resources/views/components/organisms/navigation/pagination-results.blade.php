<div {{ $attributes->merge(['class' => "{$width} font-semibold text-base text-gray-700 dark:text-slate-200 tracking-[0.25px] tabular-nums whitespace-nowrap"]) }}>
    @if($totalCount > 0) {{ $resultText }} @else {{ $noResults }} @endif
</div>
