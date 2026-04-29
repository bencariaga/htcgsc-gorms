<div id="passwordModal" x-data="{ showErrors: @js($hasPasswordErrors) }" x-init="if (showErrors) { setTimeout(() => showErrors = false, 5000) }" class="{{ $hasPasswordErrors ? 'flex' : 'hidden' }} fixed inset-0 z-[100] items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="toggleModal(false)"></div>

    <div class="max-w-md w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-gray-300 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl text-slate-800 dark:text-white font-bold">Change Password</h3>
            <button type="button" @click="toggleModal(false); showErrors = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="px-6 pb-6">
            <form wire:submit.prevent="updatePassword" id="passwordForm" class="space-y-5">

                <div class="space-y-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Full Name</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-user absolute left-4 text-slate-400"></i>
                        <input type="text" name="full_name" wire:model.defer="passwordForm.full_name_confirmation" placeholder="{{ $fullName }}" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 {{ $errors->has('passwordForm.full_name_confirmation') ? 'border-red-500' : 'border-gray-300 dark:border-slate-700' }} rounded-xl focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 bg-gray-100 focus:bg-white dark:bg-slate-900 dark:text-white !placeholder-black/30 dark:!placeholder-white/30 placeholder:font-semibold transition-all">
                    </div>
                    <template x-if="showErrors">
                        @error('passwordForm.full_name_confirmation') <span class="text-red-500 text-[13px] leading-[1.5] font-semibold">{{ $message }}</span> @enderror
                    </template>
                </div>

                <div class="space-y-1" x-data="{ show: false }">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">New Password</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-lock absolute left-4 text-slate-400"></i>
                        <input :type="show ? 'text' : 'password'" name="newPassword" wire:model.defer="passwordForm.newPassword" placeholder="Minimum is 8 characters." class="w-full h-[50px] pl-12 pr-12 py-3 border-2 {{ $errors->has('passwordForm.newPassword') ? 'border-red-500' : 'border-gray-300 dark:border-slate-700' }} rounded-xl focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 bg-gray-100 focus:bg-white dark:bg-slate-900 dark:text-white !placeholder-black/30 dark:!placeholder-white/30 placeholder:font-semibold transition-all">
                        <button type="button" @click="show = !show" class="absolute right-4 focus:outline-none text-slate-400 hover:text-slate-600">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                    <template x-if="showErrors">
                        @error('passwordForm.newPassword') <span class="text-red-500 text-[13px] leading-[1.5] font-semibold">{{ $message }}</span> @enderror
                    </template>
                </div>

                <div class="space-y-1" x-data="{ show: false }">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Confirm New Password</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-check-double absolute left-4 text-slate-400"></i>
                        <input :type="show ? 'text' : 'password'" name="newPassword_confirmation" wire:model.defer="passwordForm.newPassword_confirmation" placeholder="Repeat that password." class="w-full h-[50px] pl-12 pr-12 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 bg-gray-100 focus:bg-white dark:bg-slate-900 dark:text-white !placeholder-black/30 dark:!placeholder-white/30 placeholder:font-semibold transition-all">
                        <button type="button" @click="show = !show" class="absolute right-4 focus:outline-none text-slate-400 hover:text-slate-600">
                            <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" @click="toggleModal(false); showErrors = false" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all group">
                        <i class="fas fa-times opacity-80 group-hover:scale-110 transition-transform"></i>
                        <span>Cancel</span>
                    </button>
                    <button type="submit" class="flex-1 flex justify-center items-center gap-3 px-4 py-2 font-bold text-lg text-red-600 dark:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-xl transition-all group">
                        <i class="fas fa-check opacity-80 group-hover:scale-110 transition-transform"></i>
                        <span>Confirm</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
