@props(['perPage', 'type' => null])

@use('App\Enums\NonDB\PaginationStyling')

@php
    $options = PaginationStyling::getRowsPerPageOptions();
@endphp

<div x-data="{
    open: false,
    currentPerPage: @js($perPage),
    setPerPage(value) {
        this.currentPerPage = value;
        $wire.set('perPage', value);
        this.open = false;
    }
}" wire:ignore class="relative h-[2.5rem]">
    <button x-ref="button" @click="open = !open" type="button" class="h-[2.5rem] w-[10rem] px-4 bg-white dark:bg-slate-900 border-2 border-gray-400 dark:border-slate-600 rounded-lg text-sm font-bold text-gray-700 dark:text-slate-300 focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-list-ol text-xl text-slate-400"></i>
            <span x-cloak>
                <span x-text="currentPerPage === 'all' ? 'All' : currentPerPage"></span> Rows
            </span>
        </div>
        <i class="fas fa-caret-down text-slate-500 text-xl transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
    </button>

    <div x-show="open" x-anchor.bottom-end="$refs.button" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak class="absolute z-[1001] w-[100px] mt-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden">
        <div class="p-1 grid grid-cols-1">
            @foreach($options as $value)
                <button @click="setPerPage('{{ $value }}')" :class="String(currentPerPage) === '{{ $value }}' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'hover:bg-slate-100 dark:hover:bg-slate-700 dark:text-slate-300'" class="w-full text-left px-4 py-2 text-sm whitespace-nowrap font-semibold transition-colors rounded-lg">
                    {{ $value === 'all' ? 'All' : $value }} Rows
                </button>
            @endforeach
        </div>
    </div>
</div>
