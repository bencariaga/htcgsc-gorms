@use('App\Enums\NonDB\AuthenticationStyling')

<form wire:submit.prevent="{{ $submitAction }}" class="space-y-5">
    @foreach(AuthenticationStyling::sections($context) as $key => $section)
        <div class="{{ $context === 'otp' ? $section['grid'] : "grid grid-cols-1 {$section['grid']} gap-x-6 gap-y-4" }}">
            @foreach($section['fields'] as $field)
                @if(($field['type'] ?? '') === 'otp')
                    <input type="text" inputmode="numeric" pattern="[0-9]*" maxlength="1" wire:model="{{ $field['model'] }}" x-ref="otp{{ $field['index'] }}" x-on:input="handleInput($event, {{ $field['index'] }})" x-on:keydown.backspace="handleBackspace($event, {{ $field['index'] }})" x-on:keydown.left="handleArrows($event, {{ $field['index'] }})" x-on:keydown.right="handleArrows($event, {{ $field['index'] }})" x-on:paste="handlePaste($event)" autocomplete="off" class="{{ $field['span'] }} border-2 border-gray-400 bg-gray-200/80 rounded-xl focus:outline-none focus:border-[#2575fc] focus:bg-white text-center text-2xl font-bold transition-all">
                @else
                    <x-atoms.inputs.auth-input :label="$field['label'] ?? null" :model="$field['model']" :placeholder="$field['placeholder'] ?? ''" :type="$field['type'] ?? 'text'" :icon="$field['icon'] ?? 'fa-lock'" :required="$field['required'] ?? false" class="{{ $field['span'] }}" />
                @endif
            @endforeach

            @if($context === 'register' && $key === 'auth')
                <div class="space-y-1 md:col-span-1">
                    <label class="block text-base font-semibold invisible">Submit</label>

                    <button type="submit" class="w-full h-[50px] btn-primary-gradient py-2 flex justify-center items-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed">
                        <span class="text-lg">Request Account Creation</span>
                    </button>
                </div>
            @endif
        </div>
    @endforeach

    {{ $slot }}
</form>
