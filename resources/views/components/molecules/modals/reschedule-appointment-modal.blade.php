@use('App\Enums\AppointmentTime')

<script src="{{ asset('js/appointments.js') }}"></script>

<div id="{{ $id }}"
    x-data="rescheduleModal({
        holidays: {{ Js::from($holidayLookup) }},
        totalSlots: {{ $totalSlots }},
        modalId: '{{ $id }}'
    })"
    x-show="show"
    x-on:open-reschedule-modal.window="openModal($event.detail)"
    x-on:close-modal.window="if ($event.detail.id === '{{ $id }}') resetModal()"
    x-on:keydown.escape.window="resetModal()"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    :class="{ 'flex': show, 'hidden': !show }"
    x-cloak>

    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="resetModal()"></div>

    <form x-on:submit.prevent="submitReschedule();" class="max-w-2xl w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden flex flex-col max-h-[90vh]">
        <div class="bg-slate-100 dark:bg-slate-800/50 px-6 py-4 flex justify-between items-center border-b border-slate-200 dark:border-slate-700">
            <div class="flex flex-col gap-1">
                <span class="text-2xl text-slate-800 dark:text-white font-bold">Rescheduling Appointment</span>
                <span class="text-base text-slate-600 dark:text-slate-300 font-semibold">Student: <span class="font-medium" x-text="studentName"></span></span>
                <span class="text-base text-slate-600 dark:text-slate-300 font-semibold">Current: <span class="font-medium" x-text="currentDate"></span></span>
            </div>

            <button type="button" x-on:click="resetModal()" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        <div class="p-6 overflow-y-auto space-y-6 custom-scrollbar">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Select New Date</label>

                    <input type="date" wire:model.live="newDate" min="{{ now($timeZone)->format('Y-m-d') }}" class="w-full h-[50px] bg-white dark:bg-slate-900 border-2 border-slate-200 dark:border-slate-700 rounded-xl px-4 py-2 text-slate-700 dark:text-slate-200 font-semibold focus:border-blue-500 focus:ring-0 transition-all [color-scheme:light] dark:[color-scheme:dark] [&::-webkit-calendar-picker-indicator]:cursor-pointer [&::-webkit-calendar-picker-indicator]:p-1 [&::-webkit-calendar-picker-indicator]:rounded-md hover:[&::-webkit-calendar-picker-indicator]:bg-blue-200 dark:hover:[&::-webkit-calendar-picker-indicator]:bg-blue-800 [&::-webkit-datetime-edit]:p-0 [&::-webkit-datetime-edit-fields-wrapper]:p-0">

                    <div wire:loading wire:target="newDate" class="text-blue-500 dark:text-blue-400 text-lg font-bold mt-1">
                        <i class="fas fa-spinner fa-spin mr-1"></i> <p class="inline">Checking availability...</p>
                    </div>

                    <div wire:loading.remove wire:target="newDate">
                        <template x-if="isWeekend">
                            <p class="text-red-500 text-lg font-bold mt-1">Appointments cannot be scheduled on weekends.</p>
                        </template>

                        <template x-if="holidayName">
                            <p class="text-red-500 text-lg font-bold mt-1" x-html="'This day is not available due to<br>' + holidayName"></p>
                        </template>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Select New Time Slot</label>
                    <div class="grid grid-cols-1 gap-2">
                        @foreach(AppointmentTime::cases() as $time)
                            <button type="button" wire:key="slot-{{ $time->value }}" x-on:click="$wire.set('newTime', '{{ $time->value }}')" wire:loading.attr="disabled" wire:target="newDate" :disabled="!isSlotAvailable('{{ $time->value }}', '{{ $time->toIsoTime() }}')" :class="{ 'border-emerald-500 bg-emerald-50 dark:bg-emerald-500/10 ring-2 ring-emerald-500/20': $wire.newTime === '{{ $time->value }}', 'border-slate-300 dark:border-slate-700 hover:border-blue-400 dark:hover:border-blue-500': $wire.newTime !== '{{ $time->value }}' && isSlotAvailable('{{ $time->value }}', '{{ $time->toIsoTime() }}'), 'opacity-80 cursor-not-allowed bg-slate-200 dark:bg-slate-900 border-slate-300 dark:border-slate-800': !isSlotAvailable('{{ $time->value }}', '{{ $time->toIsoTime() }}') }" class="w-full h-[50px] text-left px-4 py-2 rounded-xl border-2 font-semibold text-slate-700 dark:text-slate-200 transition-all flex items-center justify-between group">
                                <span class="tracking-tight tabular-nums">{{ $time->rescheduleAppointmentModal() }}</span>

                                <div class="flex items-center gap-2">
                                    <template x-if="$wire.newTime === '{{ $time->value }}'">
                                        <i class="fas fa-check text-base text-emerald-600 dark:text-emerald-400"></i>
                                    </template>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-4 p-6 border-t border-slate-100 dark:border-slate-700/50 bg-slate-100/50 dark:bg-slate-800/50">
            <button type="button" x-on:click="resetModal()" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all">
                <i class="fas fa-times"></i><span>Cancel</span>
            </button>

            <button type="submit" :disabled="!canSubmit" wire:loading.attr="disabled" :class="{ 'opacity-50 cursor-not-allowed grayscale': !canSubmit }" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-slate-700 rounded-xl transition-all">
                <i class="fas fa-calendar-check"></i><span>Reschedule</span>
            </button>
        </div>
    </form>
</div>
