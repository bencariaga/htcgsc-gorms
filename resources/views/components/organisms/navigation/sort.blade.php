@props(['sortField', 'sortDirection', 'idColumn', 'alphaColumn', 'type'])

@use('App\Enums\NonDB\PaginationStyling')

@php
    $options = PaginationStyling::getSortOptions($idColumn, $alphaColumn);
@endphp

<div x-data="{
    open: false,
    currentField: @entangle('sortField').live,
    currentDirection: @entangle('sortDirection').live,
    options: {{ Js::from($options) }},
    setSort(field, direction) {
        this.currentField = field;
        this.currentDirection = direction;
        $wire.set('sortField', field);
        $wire.set('sortDirection', direction);
        this.open = false;
    },
    get activeLabel() {
        const active = this.options.find(opt => opt.field === this.currentField && opt.direction === this.currentDirection);
        return active ? active.label : 'Sort By';
    }
}" wire:ignore class="relative h-[2.5rem]">
    <button x-ref="button" @click="open = !open" type="button" class="h-[2.5rem] w-[15.25rem] px-4 bg-white dark:bg-slate-900 border-2 border-gray-400 dark:border-slate-600 rounded-lg text-sm font-bold text-gray-700 dark:text-slate-300 focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 hover:border-emerald-500 dark:hover:border-emerald-500 transition-all flex items-center justify-between">
        <div class="flex items-center gap-3">
            <i class="fa-solid fa-arrow-up-wide-short text-xl text-slate-400"></i>
            <span x-cloak x-text="activeLabel"></span>
        </div>
        <i class="fas fa-caret-down text-slate-500 text-xl transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
    </button>

    <div x-show="open" x-anchor.bottom-end="$refs.button" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-cloak class="absolute z-[1001] w-[11.75rem] mt-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden">
        <div class="p-1 grid grid-cols-1">
            @foreach($options as $option)
                <button @click="setSort('{{ $option['field'] }}', '{{ $option['direction'] }}')" :class="currentField === '{{ $option['field'] }}' && currentDirection === '{{ $option['direction'] }}' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/40 dark:text-emerald-400' : 'hover:bg-slate-100 dark:hover:bg-slate-700 dark:text-slate-300'" class="w-full text-left px-4 py-2 text-sm whitespace-nowrap font-semibold transition-colors rounded-lg">
                    {{ $option['label'] }}
                </button>
            @endforeach
        </div>
    </div>
</div>
