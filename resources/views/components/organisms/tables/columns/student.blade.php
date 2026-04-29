<td class="{{ $cellStyling }}">
    <span class="font-semibold text-sm text-gray-900 dark:text-white whitespace-nowrap">
        {!! $referrer !!}
    </span>
</td>

<td class="{{ $cellStyling }}">
    @if($latestAppointment)
        <x-atoms.utility.status-dot :status="$latestAppointment->referral_type" />
    @else
        <span class="font-[900] text-sm text-gray-900 dark:text-white">Not a referral yet</span>
    @endif
</td>

<td class="{{ $cellStyling }}">
    <span class="text-base font-bold text-slate-700 dark:text-slate-200 whitespace-nowrap">
        {{ data_get($item, 'formatted_student_id') }}
    </span>
</td>
