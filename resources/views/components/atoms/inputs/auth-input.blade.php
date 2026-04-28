@use('App\Enums\Enums')
@use('App\Enums\NonDB\AuthenticationStyling')

<div {{ $attributes->merge(['class' => 'space-y-1']) }} @if(AuthenticationStyling::INPUT_CANVAS->is($type, 'password')) x-data="{ show: false }" @endif>
    @if($label || AuthenticationStyling::INPUT_CANVAS->is($type, 'suffix'))
        <label class="{{ AuthenticationStyling::LABEL_BASE->value }}">
            {{ $label ?? 'Suffix' }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <div class="relative flex items-center">
        @if(AuthenticationStyling::INPUT_CANVAS->is($type, 'suffix'))
            <div class="w-full relative" x-data="{ open: false, selected: @entangle($model).live }" @click.away="open = false">
                <button type="button" @click="open = !open" class="{{ AuthenticationStyling::INPUT_CANVAS->value }} {{ AuthenticationStyling::DEFAULT_PADDING_RIGHT->value }} text-left flex items-center justify-between"><span x-text="selected || 'N / A'"></span></button>

                <i class="fas {{ $icon }} {{ AuthenticationStyling::ICON_BASE->value }} top-1/2 -translate-y-1/2"></i>

                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-300" :class="{ 'rotate-180': open }">
                    <i class="fas fa-caret-down text-xl text-slate-500"></i>
                </div>

                <div x-show="open" x-cloak class="absolute z-50 w-full mt-2 border border-gray-400 rounded-xl bg-gray-100 shadow-xl overflow-hidden">
                    <div class="grid grid-cols-2 p-1 gap-1">
                        <button type="button" @click="selected = ''; open = false" class="w-full text-left px-4 py-2 text-[18px] transition-colors rounded-lg" :class="(!selected) ? 'font-bold bg-emerald-100 text-emerald-600' : 'hover:bg-slate-100'">N / A</button>

                        @foreach(Enums::suffixes() as $value => $label)
                            <button type="button" @click="selected = '{{ $value }}'; open = false" class="w-full text-left px-4 py-2 text-[18px] transition-colors rounded-lg" :class="(selected === '{{ $value }}') ? 'font-bold bg-emerald-100 text-emerald-600' : 'hover:bg-slate-200'">{{ $label }}</button>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <i class="fas {{ $icon }} {{ AuthenticationStyling::ICON_BASE->value }}"></i>

            <input @if(AuthenticationStyling::INPUT_CANVAS->is($type, 'password')) autocomplete="off" :type="show ? 'text' : 'password'" @else type="{{ $type }}" @endif wire:model="{{ $model }}" placeholder="{{ $placeholder }}" class="{{ AuthenticationStyling::INPUT_CANVAS->value }} {{ AuthenticationStyling::INPUT_CANVAS->is($type, 'password') ? AuthenticationStyling::PASSWORD_PADDING_RIGHT->value : AuthenticationStyling::DEFAULT_PADDING_RIGHT->value }} {{ $errors->has($model) ? AuthenticationStyling::INPUT_ERROR->value : '' }}">

            @if(AuthenticationStyling::INPUT_CANVAS->is($type, 'password'))
                <button type="button" @click="show = !show" class="absolute right-4 focus:outline-none text-gray-500 hover:text-slate-600"><i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i></button>
            @endif
        @endif
    </div>

    <x-atoms.feedback.validation-error :field="$model" />
</div>
