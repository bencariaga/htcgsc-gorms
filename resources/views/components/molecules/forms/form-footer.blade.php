@if(($bladeViewName ?? '') === 'livewire.authentication.login')
    <div class="flex justify-center items-center">
        <a href="{{ route('password.forgot') }}" wire:navigate class="text-[#00b] font-semibold hover:underline hover:text-[#2575fc]">Forgot password?</a>
    </div>

    <button type="submit" wire:loading.attr="disabled" class="w-full btn-primary-gradient py-2 flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
        <span class="text-lg">Sign In</span>
        <i class="fas fa-arrow-right text-sm"></i>
    </button>

    <div class="text-center mb-3 pt-2">
        <p class="text-gray-600 text-base font-semibold">
            Don't have an account?<br>
            <a href="{{ route('account.create') }}" wire:navigate class="text-[#00b] font-semibold hover:underline hover:text-[#2575fc]">Request the admin to create yours.</a>
        </p>
    </div>
@elseif(($bladeViewName ?? '') === 'livewire.authentication.forgot-password')
    <div class="flex gap-3 pt-2">
        <a href="{{ route('login') }}" wire:navigate class="basis-[47%] flex justify-center items-center gap-3 px-4 py-2 font-bold text-[17px] text-blue-600 hover:bg-blue-100 rounded-xl transition-all group">
            <i class="fas fa-arrow-left opacity-80 group-hover:-translate-x-1 transition-transform"></i>
            <span>Back to Login</span>
        </a>

        <button type="submit" class="basis-[53%] flex justify-center items-center gap-3 px-4 py-2 font-bold text-[17px] text-emerald-600 hover:bg-emerald-100 rounded-xl transition-all group">
            <i class="fas fa-save opacity-80 group-hover:scale-110 transition-transform"></i>
            <span>Reset Password</span>
        </button>
    </div>
@else
    <div class="flex flex-col gap-4 pt-3">
        <button type="submit" class="w-full btn-primary-gradient py-4 hover:-translate-y-1 text-lg">Verify and Proceed</button>

        <button type="button" wire:click="goBack" class="text-center w-full border-2 border-[#2575fc] text-[#00b] rounded-xl py-4 text-lg font-semibold hover:-translate-y-1 hover:bg-blue-100 transition-all">
            {{ $backButtonText }}
        </button>
    </div>
@endif
