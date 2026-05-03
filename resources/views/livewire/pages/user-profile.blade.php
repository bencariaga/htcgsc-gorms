<div class="max-w-4xl mx-auto relative">
    <x-molecules.loading-screens.ls id="loadingProfile" message="Updating user profile..." />
    <x-molecules.loading-screens.ls id="loadingPassword" message="Updating user password..." />

    <div class="bg-white dark:bg-slate-800 shadow-xl rounded-2xl overflow-hidden">
        <x-molecules.forms.user-profile-form :user="$user" :person="$person" :suffixes="\App\Enums\Enums::suffixes()" :loader-id="'loadingProfile'" />
    </div>

    <x-molecules.modals.user-password-modal :fullName="$fullName" :user="$user" />
</div>
