<tr {{ $attributes->merge(['class' => 'hover:bg-emerald-200/50 dark:hover:bg-emerald-800/50 even:bg-slate-300/30 dark:even:bg-slate-700/50 transition-colors']) }}>
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <x-atoms.images.user-avatar :user="$item" :person="$person" class="h-10 w-10" />

            <span class="whitespace-nowrap font-semibold text-sm text-black dark:text-white">{{ $formalName }}</span>
        </div>
    </td>

    <td class="px-4 py-4">
        <div class="text-sm font-semibold text-gray-600 dark:text-slate-300">{{ $emailAddress }}</div>
        <div class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $phoneNumber }}</div>
    </td>

    <x-dynamic-component :component="'organisms.tables.columns.user'" :item="$item" :person="$person" cell-styling="px-6 py-4 h-[4.5rem]" />

    <td class="px-6 py-4 whitespace-nowrap text-right text-[15px] font-medium">
        <div class="flex justify-evenly items-center gap-4">
            <x-atoms.buttons.action-buttons.user-group :item="$item" :isAdmin="$isAdmin" :fullName="$fullName" :config="$config" />
        </div>
    </td>
</tr>
