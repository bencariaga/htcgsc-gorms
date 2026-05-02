@props(['suffixes'])

<div class="space-y-1 md:col-span-1">
    <x-atoms.forms.field-label label="Suffix" />

    <div class="relative" @click.away="suffixOpen = false">
        <input type="hidden" name="suffix" x-model="form.suffix">

        <button type="button" @click="suffixOpen = !suffixOpen" :class="isDirty('suffix') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all text-left flex items-center justify-between dark:text-white">
            <span x-text="form.suffix || 'N / A'"></span>
        </button>

        <x-atoms.forms.field-icon icon="fa-user" class="top-1/2 -translate-y-1/2" />

        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-300" :class="{ 'rotate-180': suffixOpen }">
            <i class="fas fa-caret-down text-2xl text-slate-500"></i>
        </div>

        <div x-show="suffixOpen" x-transition x-cloak class="absolute z-50 w-full mt-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-2 p-1 gap-1">
                <button type="button" @click="form.suffix = ''; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800" :class="!form.suffix ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-700 dark:text-slate-300'">
                    N / A
                </button>

                @foreach($suffixes as $value => $label)
                    <button type="button" @click="form.suffix = '{{ $value }}'; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800" :class="form.suffix === '{{ $value }}' ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-700 dark:text-slate-300'">
                        {{ $label }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>
</div>
