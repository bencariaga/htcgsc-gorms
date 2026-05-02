<button type="button" @disabled(data_get($item, 'is_finalized')) @click="$dispatch('open-modal', { id: 'confirmationModal', appointmentId: @js(data_get($item, 'appointment_id')), name: @js($fullName), action: 'complete' })" class="text-blue-600 dark:text-blue-400 hover:text-blue-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Mark as Done
</button>

<button type="button" @disabled(data_get($item, 'is_finalized')) @click="$dispatch('open-modal', { id: 'confirmationModal', appointmentId: @js(data_get($item, 'appointment_id')), name: @js($fullName), action: 'cancel' })" class="text-red-600 dark:text-red-400 hover:text-red-800 font-bold transition-colors disabled:opacity-30 disabled:cursor-not-allowed">
    Cancel
</button>
