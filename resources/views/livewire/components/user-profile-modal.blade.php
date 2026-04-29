<div x-data="{ show: @entangle('show') }" x-show="show" class="hidden fixed inset-0 z-[100] items-center justify-center p-4" :class="{ 'flex': show, 'hidden': !show }" x-cloak>
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" x-on:click="show = false"></div>

    @if($user)
        <div class="max-w-4xl w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
            <div class="bg-slate-50 dark:bg-slate-800/50 px-8 py-6 flex justify-between items-center border-b border-slate-100 dark:border-slate-700">
                <div>
                    <h2 class="text-2xl font-bold text-slate-800 dark:text-white">User Profile Settings</h2>
                    <p class="text-base text-slate-500 dark:text-slate-400 mt-1 font-medium transition-colors duration-300">Manage the information of this user account.</p>
                </div>

                <button type="button" x-on:click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>

            <x-molecules.forms.user-profile-form :user="$user" :person="$person" :suffixes="$suffixes" :modal="true" :id="$modalId" />
        </div>
    @endif

    <script src="{{ asset('js/user-profile-modal.js') }}"></script>
</div>
