<div x-data="{ show: @entangle('show') }" x-on:close-modal.window="if($event.detail.id === '{{ $modalId }}') show = false" x-show="show" class="hidden fixed inset-0 z-[100] items-center justify-center p-4" :class="{ 'flex': show, 'hidden': !show }" x-cloak>
    <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm" x-on:click="show = false"></div>

    @if($user)
        <div class="max-w-4xl w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
            <x-molecules.loading-screens.ls id="loadingProfileModal" message="Updating user profile..." />

            <div class="bg-slate-50 dark:bg-slate-800 px-6 py-3 flex justify-end items-center border-b border-slate-200 dark:border-slate-700">
                <button type="button" x-on:click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <x-molecules.forms.user-profile-form :user="$user" :person="$person" :suffixes="$suffixes" :modal="true" :id="$modalId" :loader-id="'loadingProfileModal'" />
        </div>
    @endif
</div>
