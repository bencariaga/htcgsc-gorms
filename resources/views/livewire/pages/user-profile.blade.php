<div class="max-w-4xl mx-auto relative">
    <div id="loadingProfile" class="hidden absolute inset-0 z-[110] bg-slate-900/60 backdrop-blur-[2px] rounded-2xl items-center justify-center flex-col gap-4">
        <div class="relative">
            <div class="h-16 w-16 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
            <i class="fas fa-user-gear absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-emerald-500 text-xl animate-pulse"></i>
        </div>
        <p class="text-white font-bold text-lg tracking-wider animate-pulse">UPDATING PROFILE...</p>
    </div>

    <div id="loadingPassword" class="hidden absolute inset-0 z-[110] bg-slate-900/60 backdrop-blur-[2px] rounded-2xl items-center justify-center flex-col gap-4">
        <div class="relative">
            <div class="h-16 w-16 border-4 border-blue-500/20 border-t-blue-500 rounded-full animate-spin"></div>
            <i class="fas fa-key absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-blue-500 text-xl animate-pulse"></i>
        </div>
        <p class="text-white font-bold text-lg tracking-wider animate-pulse">UPDATING PASSWORD...</p>
    </div>

    <div class="bg-white dark:bg-slate-800 shadow-xl border border-slate-200 dark:border-slate-700 rounded-2xl overflow-hidden">
        <x-molecules.forms.user-profile-form :user="$user" :person="$person" :suffixes="\App\Enums\Enums::suffixes()" />
    </div>

    <x-molecules.modals.user-password-modal :fullName="$fullName" :user="$user" />

    <script src="{{ asset('js/user-profile.js') }}"></script>
</div>
