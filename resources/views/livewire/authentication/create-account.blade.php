<div>
    <x-molecules.loading-screens.ls-auth target="register" message="Creating your account..." />

    <div x-data="{ showErrors: false, timeout: null, trigger() { this.showErrors = true; if (this.timeout) clearTimeout(this.timeout); this.timeout = setTimeout(() => { this.showErrors = false }, 5000); } }" x-on:validation-failed.window="trigger()" class="auth-card">
        <x-molecules.forms.form-header title="Create User Account" :form="$form" />
        <x-molecules.forms.auth-form context="register" submitAction="register" />
    </div>
</div>
