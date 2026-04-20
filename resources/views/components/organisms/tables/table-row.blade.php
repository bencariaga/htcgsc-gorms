@props(['item', 'type', 'person', 'fullName', 'config', 'emailAddress' => null, 'emailAddressLineBreak' => null, 'isUser' => false, 'isStudent' => false, 'isAppointment' => false, 'isActive' => false, 'isAdmin' => false, 'isAuditLog' => false, 'isReschedulable' => false, 'latestAppointment' => null, 'referrer' => '—', 'bookedTime' => null, 'modalBookedTime' => null, 'level' => null])

<tr {{ $attributes->merge(['class' => 'hover:bg-emerald-200/50 dark:hover:bg-emerald-800/50 even:bg-slate-300/30 dark:even:bg-slate-700/50 transition-colors']) }}>
    @if(!$isAuditLog && !$isAppointment)
        <td class="px-6 py-4">
            <div class="flex items-center gap-3">
                @if($isUser) <x-atoms.images.user-avatar :user="$item" :person="$person" class="h-10 w-10" /> @endif

                <span class="whitespace-nowrap font-semibold text-sm text-black dark:text-white">{{ $person->formal_name_with_initial }}</span>
            </div>
        </td>
    @endif

    @if(!$isAuditLog && ($isUser || $isStudent))
        <td class="px-4 py-4">
            @if($isStudent)
                <div class="relative group">
                    @if($person?->email_address)
                        <div class="invisible group-hover:visible absolute z-50 w-full text-center px-2 py-4 mb-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg left-1/2 -translate-x-1/2 bottom-full after:content-[''] after:absolute after:top-full after:left-1/2 after:-translate-x-1/2 after:border-8 after:border-transparent after:border-t-gray-900">{!! $emailAddressLineBreak !!}</div>
                    @endif

                    <div class="text-sm line-clamp-2 font-semibold text-gray-600 dark:text-slate-300 max-w-[12rem]">{{ $emailAddress ?? 'No email provided' }}</div>
                </div>
            @endif

            @if(!$isStudent) <div class="text-sm font-semibold text-gray-600 dark:text-slate-300">{{ $emailAddress }}</div> @endif

            <div class="text-sm font-medium text-gray-500 dark:text-slate-400">{{ $person->phone_number }}</div>
        </td>
    @endif

    <x-dynamic-component :component="'organisms.tables.columns.' . $type" :item="$item" :person="$person" :latestAppointment="$latestAppointment" :referrer="$referrer" :bookedTime="$bookedTime" :modalBookedTime="$modalBookedTime" :isReschedulable="$isReschedulable" :level="$level" cell-styling="px-6 py-4 h-[4.5rem]" />

    @if(!$isAuditLog)
        <td class="px-6 py-4 whitespace-nowrap text-right text-[15px] font-medium">
            <div class="flex justify-evenly items-center gap-4">
                @if($isUser) <x-atoms.buttons.action-buttons.user-group :item="$item" :isAdmin="$isAdmin" :fullName="$fullName" :config="$config" /> @endif
                @if($isStudent) <x-atoms.buttons.action-buttons.student-group :item="$item" :latestAppointment="$latestAppointment" :config="$config" /> @endif
                @if($isAppointment) <x-atoms.buttons.action-buttons.appointment-group :item="$item" :config="$config" :fullName="$fullName" :isReschedulable="$isReschedulable" /> @endif
            </div>
        </td>
    @endif
</tr>
