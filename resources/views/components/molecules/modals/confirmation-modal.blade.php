@props(['id', 'param'])

<div id="{{ $id }}" x-data="{ show: false }" x-show="show" x-on:open-modal.window="if ($event.detail.id === '{{ $id }}') show = true" x-on:close-modal.window="if ($event.detail.id === '{{ $id }}') show = false" class="hidden fixed inset-0 z-[100] items-center justify-center p-4" :class="{ 'flex': show, 'hidden': !show }" x-cloak>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="show = false"></div>

    <div class="max-w-md w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex justify-between items-center">
            <span class="text-xl text-slate-800 dark:text-white font-bold" x-text="config[actionType] ? `${config[actionType].title} ${config[actionType].target}` : ''"></span>
            <button type="button" x-on:click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="px-6 pb-6 pt-4">
            <div class="mb-6">
                <template x-if="config[actionType]">
                    <span class="text-slate-600 dark:text-slate-300 text-base leading-relaxed">
                        Are you sure you want to <strong x-text="config[actionType].msg"></strong> this
                        <span x-text="config[actionType].person"></span>
                        <span x-text="config[actionType].person === 'appointment' ? ' of ' : ' named '"></span>
                        "<strong x-text="personName"></strong>"?
                        <span x-show="config[actionType].person === 'user'">The system will send an <strong>email</strong> and a <strong>text message</strong> to the said user.</span>
                        <strong x-show="['delete', 'complete', 'cancel'].includes(actionType)">This action cannot be undone.</strong>
                    </span>
                </template>
            </div>

            <div class="flex gap-3">
                <button type="button" x-on:click="show = false" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all group">
                    <span>Cancel</span>
                </button>

                <button type="button" x-on:click="$wire[config[actionType].action]({{ $param }}); show = false; $dispatch('show-loading-accounts', { message: config[actionType].title + ' ' + config[actionType].target + '...', userName: personName })" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg rounded-xl transition-all group" :class="config[actionType] && config[actionType].color === 'danger' ? 'text-red-600 dark:text-red-500 hover:bg-red-100 dark:hover:bg-slate-700' : 'text-emerald-600 dark:text-emerald-400 hover:bg-emerald-100 dark:hover:bg-slate-700'">
                    <span>Confirm</span>
                </button>
            </div>
        </div>
    </div>
</div>
