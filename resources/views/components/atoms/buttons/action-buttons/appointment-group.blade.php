@props(['item', 'fullName'])

@use('App\Enums\AppointmentStatus')

@php $isFinalized = collect([AppointmentStatus::Done, AppointmentStatus::Cancelled])->contains($item->appointment_status); @endphp

<button type="button" @disabled($isFinalized) @click="$dispatch('open-modal', { id: 'confirmationModal', appointmentId: @js($item->appointment_id), name: @js($fullName), action: 'complete' })" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Mark as Done
</button>

<button type="button" @disabled($isFinalized) @click="$dispatch('open-modal', { id: 'confirmationModal', appointmentId: @js($item->appointment_id), name: @js($fullName), action: 'cancel' })" class="text-red-600 dark:text-red-400 hover:text-red-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Cancel
</button>
