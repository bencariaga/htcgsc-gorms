@props(['title', 'form', 'description', 'identifier'])

@if(($bladeViewName ?? '') === 'livewire.authentication.login')
    <div class="text-center mb-8">
        <div class="flex items-center justify-center gap-3 mb-5">
            <x-atoms.images.system-logo class="max-h-24" />
            <h1 class="text-[22px] font-bold gradient-text">Guidance Office Records Management System</h1>
        </div>
    </div>
@elseif(($bladeViewName ?? '') === 'livewire.authentication.create-account')
    <div class="flex justify-center items-center gap-6 mb-4 pb-4 border-slate-100">
        <div class="relative group">
            <div class="h-[8rem] w-[8rem] rounded-2xl overflow-hidden border-2 border-gray-400 shadow-sm bg-slate-50 transition-colors duration-300 flex items-center justify-center">
                @if ($form->profilePicture)
                    <img src="{{ $form->profilePicture->temporaryUrl() }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-slate-300 transition-colors duration-300">
                        <i class="fas fa-user-circle text-7xl"></i>
                    </div>
                @endif
            </div>

            @if ($form->profilePicture)
                <button type="button" wire:click="$set('form.profilePicture', null)" class="absolute -bottom-2 -right-2 bg-red-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-trash-can text-sm"></i>
                </button>
            @else
                <label class="absolute -bottom-2 -right-2 bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-pencil text-sm"></i>
                    <input type="file" wire:model="form.profilePicture" class="hidden" accept="image/*">
                </label>
            @endif
        </div>

        <div class="ml-4">
            <h2 class="text-[1.5rem] font-bold text-slate-800 transition-colors duration-300">
                {{ $title }}
            </h2>
            <p class="text-slate-600 text-base font-semibold mt-1">
                Already have an account? <a href="{{ route('login') }}" wire:navigate class="text-[#00b] font-semibold hover:underline hover:text-[#2575fc]">Go to Login</a>.
            </p>
        </div>
    </div>
@elseif(($bladeViewName ?? '') === 'livewire.authentication.forgot-password')
    <div class="bg-slate-50 px-6 py-4 flex justify-between items-center">
        <h3 class="text-xl text-slate-800 font-bold">{{ $title }}</h3>
        <a href="{{ route('login') }}" wire:navigate class="text-gray-500 hover:text-slate-600 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </a>
    </div>
@else
    <div class="text-center mb-3">
        <h1 class="text-xl font-bold gradient-text mb-2">{{ $title }}</h1>
        <p class="text-gray-600">
            <span class="font-semibold">{{ $description }}</span><br>
            <strong class="text-[18px]">{{ $identifier }}</strong>
        </p>
    </div>
@endif
