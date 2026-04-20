<div x-data="otpTimer({{ Session::get('otp_expires_at', 0) }})" @resend-otp.window="resetTimer(180)">
    <x-molecules.loading-screens.ls-auth target="verify" message="Verifying OTP..." />
    <x-molecules.loading-screens.ls-auth target="resend" message="Requesting to resend OTP..." />
    <x-molecules.loading-screens.ls-auth target="goBack" message="{{ $loadingMessage }}" />

    <div class="auth-card">
        <x-molecules.forms.form-header :title="$title" :description="$description" :identifier="$identifier" />

        <div x-data="otpHandler($wire)">
            <label class="block mb-6 font-semibold text-black text-center">
                <span wire:ignore>Enter the OTP valid for <span x-text="remaining"></span> seconds.</span><br>
                OTP expired or not received? <a href="#" wire:click.prevent="resend" class="text-[#00b] font-semibold hover:underline">Resend OTP</a>.
            </label>

            <x-molecules.forms.auth-form context="otp" submitAction="verify">
                <div class="mt-6 text-center">
                    @if (session()->has('message'))
                        <div wire:key="message-{{ now() }}" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" x-transition.duration.500ms class="text-green-600 font-bold text-base">
                            {{ session('message') }}
                        </div>
                    @endif

                    <x-atoms.feedback.validation-error field="otp" />
                </div>

                <x-molecules.forms.form-footer :backButtonText="$backButtonText" :loadingMessage="$loadingMessage" />
            </x-molecules.forms.auth-form>
        </div>
    </div>
</div>

<script src="{{ asset('js/otp-page.js') }}"></script>
