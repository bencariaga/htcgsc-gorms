@props(['items', 'type', 'perPage', 'sortField', 'sortDirection', 'idColumn', 'alphaColumn', 'groupClass' => 'flex-row justify-between'])

@use('Illuminate\Pagination\LengthAwarePaginator')

<div class="px-6 py-3 bg-white dark:bg-slate-800 border-b-2 border-gray-300 dark:border-slate-700 flex flex-col space-y-4 rounded-t-[calc(1rem-2px)]">
    <div class="flex flex-col justify-center items-center gap-3">
        <div class="w-full flex items-center {{ $groupClass }}">
            <x-organisms.navigation.pagination-results :items="$items" :type="$type" />
            <x-organisms.navigation.search :type="$type" />
            <x-organisms.navigation.rows-per-page :perPage="$perPage" :type="$type" />
            <x-organisms.navigation.sort :sortField="$sortField" :sortDirection="$sortDirection" :idColumn="$idColumn" :alphaColumn="$alphaColumn" :type="$type" />
        </div>

        @if($items instanceof LengthAwarePaginator && $perPage !== 'all' && $items->hasPages())
            <div class="w-full flex justify-center overflow-x-auto [scrollbar-width:thin] [scrollbar-color:rgba(107,114,128,0.8)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-500/80">
                <x-organisms.navigation.pagination :paginator="$items" />
            </div>
        @endif
    </div>
</div>
