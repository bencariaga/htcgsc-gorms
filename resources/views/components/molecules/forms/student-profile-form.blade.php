@use('App\Enums\NonDB\ProfileFormStyling')

@once <script src="{{ asset('js/student-profile.js') }}"></script> @endonce

<form id="{{ $id }}" action="{{ route('student-profile.update') }}" method="POST" x-data="studentProfileForm({ formId: '{{ $id }}', modal: @js($modal) })" @submit.prevent="submit()" x-cloak>
    @csrf

    <input type="hidden" name="student_id" x-model="form.student_id">

    <div class="bg-slate-50 dark:bg-slate-800/50 px-8 py-6 flex justify-between items-center border-b border-slate-100 dark:border-slate-700">
        <div>
            <h2 class="text-2xl font-bold text-slate-800 dark:text-white">Student Profile Settings</h2>
            <p class="text-base text-slate-500 dark:text-slate-400 mt-1 font-medium transition-colors duration-300">Manage the information of this student.</p>
        </div>

        <button type="button" x-on:click="show = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
            <i class="fas fa-times text-2xl"></i>
        </button>
    </div>

    <div class="p-8 space-y-6">
        @foreach(ProfileFormStyling::sections('student') as $key => $section)
            <div class="{{ $section['grid'] }} gap-6">
                @foreach($section['fields'] as $field)
                    <div class="space-y-1 {{ $field['colSpan'] }}">
                        <x-atoms.forms.field-label :label="$field['label']" :required="$field['required']" />

                        <div class="relative flex items-center">
                            <x-atoms.forms.field-icon :icon="$field['icon']" />
                            <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}" x-model="form.{{ $field['name'] }}" {!! $field['extra'] ?? '' !!} :class="isDirty('{{ $field['name'] }}') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                        </div>
                    </div>
                @endforeach

                @if($key === 'main')
                    <x-molecules.forms.suffix-dropdown :suffixes="\App\Enums\Enums::suffixes()" />
                @endif
            </div>
        @endforeach
    </div>

    <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/50 border-t border-slate-100 dark:border-slate-700">
        <x-molecules.forms.profile-action-bar />
    </div>
</form>
