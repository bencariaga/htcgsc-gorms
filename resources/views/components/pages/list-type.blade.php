@props(['filter', 'items', 'perPage', 'sortField', 'sortDirection', 'columns', 'type', 'modalParam' => 'id', 'modalConfig' => [], 'idColumn' => 'id', 'alphaColumn' => 'name', 'selectedFileName' => null])

@use('Illuminate\Support\Js')

<div class="px-6 py-3 transition-colors duration-300">
    <x-molecules.loading-screens.ls-list-type />

    <div class="bg-white dark:bg-slate-800 mb-[4.5rem] rounded-2xl shadow-md overflow-visible border-2 border-gray-300 dark:border-slate-700">
        <x-organisms.navigation.pagination-group :items="$items" :type="$type" :perPage="$perPage" :sortField="$sortField" :sortDirection="$sortDirection" :idColumn="$idColumn" :alphaColumn="$alphaColumn" />
        <x-organisms.tables.table :columns="$columns" :items="$items" :type="$type" />
        <x-organisms.tables.infinite-scroll-loader :data="$items" :perPage="$perPage" />

        <div x-data="{ itemId: null, personName: '', actionType: '', config: {{ Js::from($modalConfig) }} }" x-on:open-modal.window="if($event.detail.id === 'confirmationModal') { itemId = $event.detail.{{ $modalParam }}; personName = $event.detail.name; actionType = $event.detail.action; }">
            <x-molecules.modals.confirmation-modal id="confirmationModal" :param="'itemId'" />
        </div>

        @if($modalEnum)
            {!! $modalEnum->renderModal() !!}
        @endif
    </div>

    <x-atoms.buttons.button-groups.filter-button-group :type="$type" :fileName="$selectedFileName" :filter="$filter" />
</div>

<script src="{{ asset('js/list-type.js') }}"></script>
