@props(['modal' => true, 'id'])

<form id="{{ $id }}" action="{{ route('student-profile.update') }}" method="POST" x-data="{
    modal: @js($modal),
    show: @js(!$modal),
    student: {},
    form: {
        student_id: '',
        last_name: '',
        first_name: '',
        middle_name: '',
        suffix: '',
        email_address: '',
        phone_number: ''
    },
    original: {},
    suffixOpen: false,

    init() {
        if (this.modal) {
            this.show = true;
        }

        window.addEventListener('open-modal', (event) => {
            if (event.detail.id === '{{ $id }}') {
                this.student = event.detail.student;
                const person = this.student.person;

                this.form = {
                    student_id: this.student.student_id,
                    last_name: person.last_name,
                    first_name: person.first_name,
                    middle_name: person.middle_name || '',
                    suffix: person.suffix || '',
                    email_address: person.email_address,
                    phone_number: person.phone_number || ''
                };

                this.original = { ...this.form };
                this.show = true;
            }
        });
    },

    isDirty(field) {
        return this.form[field] !== this.original[field];
    },

    get anyDirty() {
        return Object.keys(this.form).some(field => this.isDirty(field));
    },

    resetForm() {
        this.form = { ...this.original };
    },

    sanitize() {
        this.form.first_name = this.form.first_name.replace(/\s/g, '');
        this.form.phone_number = this.form.phone_number.replace(/[^0-9+]/g, '');
    },

    submit() {
        this.$dispatch('show-loading-accounts', {
            message: 'Updating student profile...',
            userName: [this.form.first_name, this.form.middle_name, this.form.last_name, this.form.suffix].filter(Boolean).join(' '),
        });

        fetch(this.$el.action, {
            method: 'POST',
            body: new FormData(this.$el),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            }
        })
        .then(async response => {
            const data = await response.json();

            if (response.ok) {
                this.original = { ...this.form };
                this.$dispatch('close-modal', { id: '{{ $id }}' });
                this.$dispatch('notify', { type: 'success', message: data.message });
                window.Livewire?.dispatch('refreshList');
            } else {
                const errorMessages = response.status === 422 ? Object.values(data.errors).flat().join(' ') : (data.message || 'An unexpected error occurred.');

                this.$dispatch('notify', {
                    type: 'error',
                    message: errorMessages
                });
            }
        })
        .catch(() => {
            this.$dispatch('notify', { type: 'error', message: 'Connection lost. Please try again.' });
        })
        .finally(() => {
            this.$dispatch('hide-loading-accounts');
        });
    }
}" x-init="init()" class="w-full" @submit.prevent="submit()" x-cloak>
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="space-y-1 md:col-span-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Last Name <span class="text-red-500">*</span></label>
                    <div class="relative flex items-center">
                        <i class="fas fa-user absolute left-4 text-slate-400"></i>
                        <input type="text" name="last_name" x-model="form.last_name" :class="isDirty('last_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">First Name <span class="text-red-500">*</span></label>
                    <div class="relative flex items-center">
                        <i class="fas fa-user absolute left-4 text-slate-400"></i>
                        <input type="text" name="first_name" x-model="form.first_name" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('first_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Middle Name</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-user absolute left-4 text-slate-400"></i>
                        <input type="text" name="middle_name" x-model="form.middle_name" :class="isDirty('middle_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Suffix</label>

                    <div class="relative" @click.away="suffixOpen = false">
                        <input type="hidden" name="suffix" x-model="form.suffix">

                        <button type="button" @click="suffixOpen = !suffixOpen" :class="isDirty('suffix') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all text-left flex items-center justify-between dark:text-white">
                            <span x-text="form.suffix || 'N / A'"></span>
                        </button>

                        <i class="fas fa-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none transition-transform duration-300" :class="{ 'rotate-180': suffixOpen }">
                            <i class="fas fa-caret-down text-2xl text-slate-500"></i>
                        </div>

                        <div x-show="suffixOpen" x-transition x-cloak class="absolute z-50 w-full mt-2 bg-white dark:bg-slate-800 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden">
                            <div class="grid grid-cols-2 p-1 gap-1">
                                <button type="button" @click="form.suffix = ''; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 dark:text-white" :class="!form.suffix ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : ''">
                                    N / A
                                </button>

                                @foreach(App\Enums\Enums::suffixes() as $value => $label)
                                    <button type="button" @click="form.suffix = '{{ $value }}'; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 dark:text-white" :class="form.suffix === '{{ $value }}' ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : ''">
                                        {{ $label }}
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-10 gap-6">
                <div class="space-y-1 md:col-span-6">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Email Address <span class="text-red-500">*</span></label>
                    <div class="relative flex items-center">
                        <i class="fas fa-envelope absolute left-4 text-slate-400"></i>
                        <input type="email" name="email_address" x-model="form.email_address" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('email_address') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>

                <div class="space-y-1 md:col-span-4">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Phone Number</label>
                    <div class="relative flex items-center">
                        <i class="fas fa-phone absolute left-4 text-slate-400"></i>
                        <input type="text" name="phone_number" x-model="form.phone_number" inputmode="tel" @input="sanitize" @blur="sanitize" :class="isDirty('phone_number') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
                    </div>
                </div>
            </div>
        </div>

        <div class="px-8 py-6 bg-slate-50 dark:bg-slate-800/50 flex flex-col sm:flex-row items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-700">
            <button type="button" @click="resetForm()" :disabled="!anyDirty" class="text-lg w-[13.75rem] flex justify-between items-center px-[25px] py-[12.5px] font-semibold text-orange-600 dark:text-orange-500 hover:bg-orange-100 dark:hover:bg-orange-900/40 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-rotate-left group-hover:scale-110 group-hover:rotate-[-45deg] transition-transform"></i>
                <span>Reset to Default</span>
            </button>

            <button type="submit" :disabled="!anyDirty" class="text-lg w-[13rem] flex justify-between items-center px-[25px] py-[12.5px] font-semibold text-emerald-600 dark:text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-900/90 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-floppy-disk opacity-80 group-hover:scale-110 transition-transform"></i>
                <span>Save Changes</span>
            </button>
        </div>
</form>
