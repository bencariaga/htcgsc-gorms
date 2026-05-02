@props(['submitText' => 'Save Changes', 'resetText' => 'Reset to Default'])

<div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 mt-2">
    {{ $slot }}

    <div class="flex flex-col sm:flex-row items-center gap-4">
        <button type="button" @click="resetForm()" :disabled="!anyDirty" class="text-lg w-[12.5rem] flex justify-between items-center px-4 py-2 font-semibold text-orange-600 dark:text-orange-500 hover:bg-orange-100 dark:hover:bg-orange-900/40 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-rotate-left mr-2.5 group-hover:scale-110 group-hover:rotate-[-45deg] transition-transform"></i>
            <span>{{ $resetText }}</span>
        </button>

        <button type="submit" :disabled="!anyDirty" class="text-lg w-[12rem] flex justify-between items-center px-4 py-2 font-semibold text-emerald-600 dark:text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-900/90 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-floppy-disk mr-2.5 opacity-80 group-hover:scale-110 transition-transform"></i>
            <span>{{ $submitText }}</span>
        </button>
    </div>
</div>
