<x-templates.personal-pages>
    <x-slot:title>User Profile</x-slot:title>

    <x-molecules.loading-screens.ls id="loadingPassword" message="Processing password change..." />
    <x-molecules.loading-screens.ls id="loadingProfile" message="Processing user profile update..." />

    <div class="max-w-[900px] mx-auto">
        <div class="shadow-xl border rounded-2xl border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-800 transition-colors duration-300">
            <x-molecules.forms.user-profile-form :user="$user" :person="$person" />
        </div>

        <x-molecules.modals.user-profile-modal :fullName="$fullName" :user="$user" />
    </div>
</x-templates.personal-pages>

<script src="{{ asset('js/user-profile.js') }}"></script>
