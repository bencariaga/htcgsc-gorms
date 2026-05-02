<div id="passwordModal" x-data="userPasswordModal(@js($hasPasswordErrors))" :class="showErrors ? 'flex' : 'hidden'" class="fixed inset-0 z-[100] items-center justify-center p-4">
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="toggleModal(false)"></div>

    <div class="max-w-md w-full relative z-10 bg-white dark:bg-slate-800 shadow-xl border border-gray-300 dark:border-slate-700 rounded-2xl overflow-hidden">
        <div class="bg-slate-50 dark:bg-slate-800/50 px-6 py-4 flex justify-between items-center">
            <h3 class="text-xl text-slate-800 dark:text-white font-bold">Change Password</h3>

            <button type="button" @click="toggleModal(false); showErrors = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <div class="px-6 pb-6">
            <form action="{{ route('user-profile.updatePassword', $user->user_id) }}" method="POST" id="passwordForm" class="space-y-5">
                @csrf
 
                @php
                    $passwordFields = [
                        ['name' => 'full_name', 'label' => 'Full Name', 'icon' => 'fa-user', 'placeholder' => $fullName, 'type' => 'text'],
                        ['name' => 'newPassword', 'label' => 'New Password', 'icon' => 'fa-lock', 'placeholder' => 'Minimum is 8 characters.', 'type' => 'password', 'canToggle' => true],
                        ['name' => 'newPassword_confirmation', 'label' => 'Confirm New Password', 'icon' => 'fa-check-double', 'placeholder' => 'Repeat that password.', 'type' => 'password', 'canToggle' => true],
                    ];
                @endphp
 
                @foreach($passwordFields as $field)
                    <div class="space-y-1" @if($field['canToggle'] ?? false) x-data="{ show: false }" @endif>
                        <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">{{ $field['label'] }}</label>
 
                        <div class="relative flex items-center">
                            <i class="fas {{ $field['icon'] }} absolute left-4 text-slate-400"></i>
                            <input @if($field['canToggle'] ?? false) :type="show ? 'text' : 'password'" @else type="{{ $field['type'] }}" @endif name="{{ $field['name'] }}" placeholder="{{ $field['placeholder'] }}" class="w-full h-[50px] pl-12 pr-12 py-3 border-2 {{ $errors->has($field['name']) ? 'border-red-500' : 'border-gray-300 dark:border-slate-700' }} rounded-xl focus:outline-none focus:border-emerald-500 dark:focus:border-emerald-500 bg-gray-100 focus:bg-white dark:bg-slate-900 dark:text-white !placeholder-black/40 dark:!placeholder-white/40 placeholder:font-semibold transition-all">
                            
                            @if($field['canToggle'] ?? false)
                                <button type="button" @click="show = !show" class="absolute right-4 focus:outline-none text-slate-400 hover:text-slate-600">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            @endif
                        </div>
 
                        @if($errors->has($field['name']))
                            <template x-if="showErrors">
                                <span class="text-red-500 text-[13px] leading-[1.5] font-semibold">@error($field['name']) {{ $message }} @enderror</span>
                            </template>
                        @endif
                    </div>
                @endforeach

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
