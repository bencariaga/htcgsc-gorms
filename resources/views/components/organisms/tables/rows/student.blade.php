<tr {{ $attributes->merge(['class' => 'hover:bg-emerald-200/50 dark:hover:bg-emerald-800/50 even:bg-slate-300/30 dark:even:bg-slate-700/50 transition-colors']) }}>
    <td class="px-6 py-4">
        <div class="flex items-center gap-3">
            <span class="whitespace-nowrap font-semibold text-sm text-black dark:text-white">{{ $formalName }}</span>
        </div>
    </td>

    <td class="px-4 py-4">
        <div class="relative group">
            @if(data_get($person, 'email_address'))
                <div class="invisible group-hover:visible absolute z-50 w-full text-center px-2 py-4 mb-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg left-1/2 -translate-x-1/2 bottom-full after:content-[''] after:absolute after:top-full after:left-1/2 after:-translate-x-1/2 after:border-8 after:border-transparent after:border-t-gray-900">{!! $emailAddressLineBreak !!}</div>
            @endif

            <div class="text-sm line-clamp-2 font-semibold text-gray-600 dark:text-slate-300 max-w-[12rem]">{{ $emailAddress ?? 'No email provided' }}</div>
        </div>

        <div class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $phoneNumber }}</div>
    </td>

    <x-dynamic-component :component="'organisms.tables.columns.student'" :item="$item" :person="$person" :latestAppointment="$latestAppointment" :referrer="$referrer" cell-styling="px-6 py-4 h-[4.5rem]" />

    <td class="px-6 py-4 whitespace-nowrap text-right text-[15px] font-medium">
        <div class="flex justify-evenly items-center gap-4">
            <x-atoms.buttons.action-buttons.student-group :item="$item" :latestAppointment="$latestAppointment" :config="$config" />
        </div>
    </td>
</tr>
