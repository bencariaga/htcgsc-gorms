@use('App\Enums\NonDB\ProfileFormStyling')

@once <script src="{{ asset('js/user-profile.js') }}"></script> @endonce

<form id="{{ $id }}" action="{{ route('user-profile.update', $user->user_id) }}" method="POST" enctype="multipart/form-data" class="space-y-6 py-[20px] px-[2rem] border-2 border-slate-300 dark:border-slate-700 rounded-2xl"
    x-data="userProfileForm({
        formId: '{{ $id }}',
        modal: @js($modal),
        isSelf: @js($isSelf),
        loaderId: @js($loaderId),
        hasErrors: @js($hasErrors),
        profilePicture: @js($profilePicture),
        initialForm: {
            last_name: @js(old('last_name', $person->last_name)),
            first_name: @js(old('first_name', $person->first_name)),
            middle_name: @js(old('middle_name', $person->middle_name)),
            suffix: @js(old('suffix', $person->suffix ?? '')),
            email_address: @js(old('email_address', $person->email_address)),
            phone_number: @js(old('phone_number', $person->phone_number)),
            remove_picture: '0',
            hasNewFile: false
        },
        originalData: {
            last_name: @js($person->last_name),
            first_name: @js($person->first_name),
            middle_name: @js($person->middle_name),
            suffix: @js($person->suffix ?? ''),
            email_address: @js($person->email_address),
            phone_number: @js($person->phone_number)
        }
    })" @submit.prevent="submit()" x-cloak>
    @csrf
    @method('PUT')

    <input type="hidden" name="remove_picture" x-model="form.remove_picture">

    <x-molecules.forms.profile-photo-editor title="User Profile Settings" description="Manage the information of your user account." />

    @foreach(ProfileFormStyling::sections() as $key => $section)
        <div class="{{ $section['grid'] }} gap-x-6 gap-y-4">
            @foreach($section['fields'] as $field)
                <div class="space-y-1 {{ $field['colSpan'] }}">
                    <x-atoms.forms.field-label :label="$field['label']" :required="$field['required']" />

                    <div class="relative flex items-center">
                        <x-atoms.forms.field-icon :icon="$field['icon']" />
                        <input type="{{ $field['type'] ?? 'text' }}" id="{{ str($field['name'])->camel() }}Input" name="{{ $field['name'] }}" x-model="form.{{ $field['name'] }}" data-original="{{ $person->{$field['name']} }}" {!! $field['extra'] ?? '' !!} :class="isDirty('{{ $field['name'] }}') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>
            @endforeach

            @if($key === 'main')
                <x-molecules.forms.suffix-dropdown :suffixes="$suffixes" />
            @endif
        </div>
    @endforeach

    <x-molecules.forms.profile-action-bar :show-password-button="true" />
</form>
