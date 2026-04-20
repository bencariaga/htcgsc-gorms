<div>
    <x-molecules.loading-screens.ls-auth target="login" message="Checking credentials..." />

    <div class="auth-card">
        <x-molecules.forms.form-header />

        <x-molecules.forms.auth-form context="login" submitAction="login">
            <x-molecules.forms.form-footer />
        </x-molecules.forms.auth-form>
    </div>
</div>
