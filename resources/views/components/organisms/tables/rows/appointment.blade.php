<tr {{ $attributes->merge(['class' => 'hover:bg-emerald-200/50 dark:hover:bg-emerald-800/50 even:bg-slate-300/30 dark:even:bg-slate-700/50 transition-colors']) }}>
    <x-dynamic-component :component="'organisms.tables.columns.appointment'" :item="$item" :person="$person" :referrer="$referrer" :bookedTime="$bookedTime" :modalBookedTime="$modalBookedTime" :isReschedulable="$isReschedulable" cell-styling="px-6 py-4 h-[4.5rem]" />

    <td class="px-6 py-4 whitespace-nowrap text-right text-[15px] font-medium">
        <div class="flex justify-evenly items-center gap-4">
            <x-atoms.buttons.action-buttons.appointment-group :item="$item" :config="$config" :fullName="$fullName" :isReschedulable="$isReschedulable" />
        </div>
    </td>
</tr>
