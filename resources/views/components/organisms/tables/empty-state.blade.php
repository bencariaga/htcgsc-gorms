@props(['type'])

@php
    use App\Enums\NonDB\PaginationStyling;

    $alias = PaginationStyling::getAlias($type);
    $displayTitle = str($alias)->plural();
@endphp

<div class="flex flex-col items-center justify-center text-center bg-white dark:bg-slate-800">
    <div class="bg-slate-200 dark:bg-slate-900/50 flex justify-center items-center rounded-full h-20 w-20 text-slate-400 dark:text-slate-500 text-3xl mb-6">
        <i class="fas fa-box-open"></i>
    </div>

    <span class="text-lg font-bold text-slate-800 dark:text-white">
        No {{ $displayTitle }} found
    </span>

    <span class="text-slate-600 dark:text-slate-400 text-base font-medium mt-2 max-w-xs">
        <button type="button" onclick="window.location.reload();" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 hover:underline font-bold transition-colors">
            Refresh the page
        </button>
    </span>
</div>
