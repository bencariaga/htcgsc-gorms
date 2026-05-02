<td class="{{ $cellStyling }}">
    <span class="text-sm font-semibold text-gray-700 dark:text-slate-200">
        {{ $person?->formal_name_with_initial }}
    </span>
</td>

<td class="{{ $cellStyling }}">
    <span class="text-base font-bold text-slate-700 dark:text-slate-200 tracking-[0.5px] tabular-nums">
        <div class="whitespace-nowrap">
            {{ data_get($item, 'formatted_appointment_id') }}
        </div>
    </span>
</td>

<td class="{{ $cellStyling }} {{ $isReschedulable ? 'group relative cursor-pointer' : '' }}" @if($isReschedulable) x-data x-on:click="$dispatch('open-reschedule-modal', { id: 'rescheduleAppointmentModal', appointmentId: {{ data_get($item, 'appointment_id') }}, formattedId: '{{ data_get($item, 'formatted_appointment_id') }}', studentName: '{{ $person?->full_name }}', currentDate: '{{ $modalBookedTime }}' })" @endif>
    <div class="{{ $isReschedulable ? 'group-hover:invisible' : '' }} text-sm font-bold text-slate-700 dark:text-slate-200 flex justify-between items-center gap-1 text-center tracking-[0.5px] tabular-nums">
        <div class="whitespace-nowrap">
            {{ $bookedTime }}
        </div>
    </div>

    @if($isReschedulable)
        <button class="absolute inset-0 z-10 hidden group-hover:flex items-center justify-center">
            <span class="text-base font-bold text-blue-600 dark:text-blue-400">
                Reschedule
            </span>
        </button>
    @endif
</td>

<td class="{{ $cellStyling }} group relative">
    @if(data_get($item, 'reason'))
        <div class="invisible group-hover:visible absolute z-50 w-fit min-w-[15rem] max-w-[18rem] text-balance text-center px-3 py-2 mb-2 text-sm text-white bg-gray-900 rounded-lg shadow-lg left-1/2 -translate-x-1/2 bottom-full after:content-[''] after:absolute after:top-full after:left-1/2 after:-translate-x-1/2 after:border-8 after:border-transparent after:border-t-gray-900">
            {{ str(data_get($item, 'reason'))->finish('.') }}
        </div>
    @endif

    <div class="text-sm font-semibold text-gray-700 dark:text-slate-200 max-w-[12rem] line-clamp-2">
        {{ str(data_get($item, 'reason'))->finish('.') ?? '—' }}
    </div>
</td>

<td class="{{ $cellStyling }}">
    <x-atoms.utility.status-dot :status="data_get($item, 'appointment_status')" />
</td>
