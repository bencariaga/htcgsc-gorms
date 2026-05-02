<div>
    <x-molecules.loading-screens.ls-auth target="resetPassword" message="Updating your password..." />

    <div x-data="{ showErrors: false, timeout: null }" x-on:validation-failed.window="showErrors = true; if (timeout) clearTimeout(timeout); timeout = setTimeout(() => { showErrors = false }, 3000);" class="auth-card min-h-[560px] w-[450px] z-10 py-2 px-1 relative overflow-hidden">
        <x-molecules.forms.form-header title="Reset User Password" />

        <div class="px-6 pb-6 pt-4">
            <x-molecules.forms.auth-form context="forgot-password" submitAction="resetPassword">
                <x-molecules.forms.form-footer />
            </x-molecules.forms.auth-form>
        </div>
    </div>
</div>
