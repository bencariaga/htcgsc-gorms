@props(['items', 'type', 'perPage', 'sortField', 'sortDirection', 'idColumn' => 'id', 'alphaColumn' => 'name'])

@use('Illuminate\Pagination\LengthAwarePaginator')

<div class="px-6 py-3 bg-white dark:bg-slate-800 border-b-2 border-gray-300 dark:border-slate-700 flex flex-col space-y-4 rounded-t-[calc(1rem-2px)]">
    <div class="flex flex-col justify-center items-center gap-3">
        <div class="w-full flex flex-row justify-between items-center">
            <x-organisms.navigation.pagination-results :items="$items" :type="$type" />
            <x-organisms.navigation.search :type="$type" />
            <x-organisms.navigation.rows-per-page :perPage="$perPage" :type="$type" />
            <x-organisms.navigation.sort :sortField="$sortField" :sortDirection="$sortDirection" :idColumn="$idColumn" :alphaColumn="$alphaColumn" :type="$type" />
        </div>

        @if($items instanceof LengthAwarePaginator && $perPage !== 'all' && $items->hasPages())
            <div class="w-full flex justify-center overflow-x-auto">
                <x-organisms.navigation.pagination :paginator="$items" />
            </div>
        @endif
    </div>
</div>
