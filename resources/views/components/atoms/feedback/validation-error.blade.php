@use('App\Enums\NonDB\AuthenticationStyling')

@error($field)
    <div wire:key="error-{{ $field }}-{{ now() }}" x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="{{ $alpineTrigger ? "{$alpineTrigger} && show" : 'show' }}" x-transition.duration.500ms class="mt-3 mb-1">
        <span class="{{ AuthenticationStyling::ERROR_TEXT->value }}">{{ $message }}</span>
    </div>
@enderror
