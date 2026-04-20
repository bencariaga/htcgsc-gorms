@props(['columns' => [], 'items' => [], 'type' => ''])

<table {{ $attributes->merge(['class' => 'w-full text-left border-collapse']) }}>
    <x-organisms.tables.table-column :columns="$columns" />

    <tbody class="divide-y-2 divide-gray-300 dark:divide-slate-700 text-sm">
        @forelse($items as $item)
            <x-organisms.tables.table-row :item="$item" :type="$type" />
        @empty
            <tr>
                <td colspan="{{ collect($columns)->count() }}" class="px-5 py-10">
                    <x-organisms.tables.empty-state :type="$type" />
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
