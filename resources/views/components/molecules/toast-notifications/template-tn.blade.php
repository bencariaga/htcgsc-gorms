<div class="fixed bottom-6 right-6 z-[150] flex flex-col gap-4 min-w-[25rem]">
    <template x-for="note in notifications" :key="note.id">
        <div x-init="setTimeout(() => { notifications = notifications.filter(n => n.id !== note.id) }, 5000)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-x-10"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 translate-x-10"
            class="relative overflow-hidden bg-white {{ $darkMode ? 'dark:bg-slate-800' : '' }} p-4 rounded-lg shadow-2xl flex items-center justify-between"
            :class="{
                'border-emerald-500': note.type === 'success',
                'border-red-500': note.type === 'error',
                'border-orange-400': note.type === 'warning',
                'border-blue-500': note.type === 'info'
            }">

            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <i class="fas text-2xl"
                        :class="{
                            'fa-circle-check text-emerald-500': note.type === 'success',
                            'fa-circle-xmark text-red-500': note.type === 'error',
                            'fa-triangle-exclamation text-orange-400': note.type === 'warning',
                            'fa-circle-info text-blue-500': note.type === 'info'
                        }"></i>
                </div>
                <div class="flex flex-col">
                    <span class="text-slate-800 {{ $darkMode ? 'dark:text-white' : '' }} font-bold font-base capitalize" x-text="note.type"></span>
                    <span class="text-slate-600 {{ $darkMode ? 'dark:text-slate-300' : '' }} font-medium text-[14px] pr-[22px]" x-html="note.message"></span>
                </div>
            </div>

            <button @click="notifications = notifications.filter(n => n.id !== note.id)" class="ml-4 text-slate-400 hover:text-slate-600 {{ $darkMode ? 'dark:hover:text-white' : '' }} transition-colors">
                <i class="fas fa-xmark text-lg"></i>
            </button>

            <div class="absolute bottom-0 left-0 h-1 bg-slate-200/30 w-full">
                <div class="h-full transition-all duration-[5000ms] linear bg-gradient-to-r"
                    x-init="$el.style.width = '100%'; setTimeout(() => $el.style.width = '0%', 10)"
                    :class="{
                        'from-emerald-500 to-emerald-500': note.type === 'success',
                        'from-red-500 to-red-500': note.type === 'error',
                        'from-orange-500 to-orange-500': note.type === 'warning',
                        'from-blue-500 to-blue-500': note.type === 'info'
                    }">
                </div>
            </div>
        </div>
    </template>
</div>
