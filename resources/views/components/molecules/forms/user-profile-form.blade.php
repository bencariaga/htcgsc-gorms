@props(['modal' => false, 'loaderId' => null])

@php
    $profilePicture = $user->profile_picture ? asset("storage/{$user->profile_picture}") : null;
    $isSelf = $user->user_id === auth()->id();
@endphp

<script src="{{ asset('js/user-profile.js') }}"></script>

<form id="profileForm" action="{{ route('user-profile.update', $user->user_id) }}" method="POST"
    enctype="multipart/form-data" class="space-y-6 py-[20px] px-[2rem]" x-data="{
        modal: @js($modal),
        isSelf: @js($isSelf),
        loaderId: @js($loaderId),
        form: {
            last_name: @js(old('last_name', $person->last_name)),
            first_name: @js(old('first_name', $person->first_name)),
            middle_name: @js(old('middle_name', $person->middle_name)),
            suffix: @js(old('suffix', $person->suffix ?? '')),
            email_address: @js(old('email_address', $person->email_address)),
            phone_number: @js(old('phone_number', $person->phone_number)),
            remove_picture: '0',
            hasNewFile: false
        },
        original: {
            last_name: @js($person->last_name),
            first_name: @js($person->first_name),
            middle_name: @js($person->middle_name),
            suffix: @js($person->suffix ?? ''),
            email_address: @js($person->email_address),
            phone_number: @js($person->phone_number)
        },
        previewUrl: @js($profilePicture),
        suffixOpen: false,
        isLoaded: false,

        init() {
            if (this.form.suffix === null) this.form.suffix = '';

            @if($errors->any())
                this.resetForm();
            @endif

            this.$nextTick(() => { this.isLoaded = true; });
        },

        isDirty(field) {
            return this.form[field] !== this.original[field];
        },

        get photoDirty() {
            return this.form.hasNewFile || this.form.remove_picture === '1';
        },

        get anyDirty() {
            const basicFields = ['last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'];
            const isFieldDirty = basicFields.some(field => this.isDirty(field));
            return isFieldDirty || this.photoDirty;
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewUrl = URL.createObjectURL(file);
                this.form.remove_picture = '0';
                this.form.hasNewFile = true;
            }
        },

        removeImage() {
            this.form.remove_picture = '1';
            this.form.hasNewFile = false;
            this.previewUrl = '';
            const fileInput = document.getElementById('profilePictureFileInput');
            if (fileInput) fileInput.value = '';
        },

        resetForm() {
            Object.keys(this.original).forEach(key => {
                this.form[key] = this.original[key];
            });

            this.form.hasNewFile = false;
            this.form.remove_picture = '0';
            this.previewUrl = @js($profilePicture);
            const fileInput = document.getElementById('profilePictureFileInput');
            if (fileInput) fileInput.value = '';
        },

        sanitize() {
            this.form.first_name = this.form.first_name.replace(/\s/g, '');
            this.form.phone_number = this.form.phone_number.replace(/[^0-9+]/g, '');
        },

        submit() {
            const personName = [this.form.first_name, this.form.middle_name, this.form.last_name, this.form.suffix].filter(Boolean).join(' ');
            const nameChanged = this.isDirty('first_name') || this.isDirty('middle_name') || this.isDirty('last_name') || this.isDirty('suffix');
            const emailChanged = this.isDirty('email_address');
            const phoneChanged = this.isDirty('phone_number');

            const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });

            if (emailChanged && phoneChanged) {
                return alert('For security reasons, you cannot change your email address and phone number at the same time. Please update them one at a time.');
            }

            if (nameChanged && (emailChanged || phoneChanged)) {
                return alert(`You cannot change your name while changing your ${emailChanged ? 'email address' : 'phone number'}.`);
            }

            if (nameChanged) {
                const names = [
                    { n: 'first name', v: this.form.first_name.trim() },
                    { n: 'middle name', v: this.form.middle_name.trim() },
                    { n: 'last name', v: this.form.last_name.trim() }
                ].filter(f => f.v && f.v.length < 2).map(f => f.n);

                if (names.length > 0) {
                    return alert(`The ${formatter.format(names)} ${names.length > 1 ? 'must all' : 'must'} be at least 2 characters long.`);
                }
            }

            if (emailChanged && !/^[a-zA-Z0-9._%+-]+@(gmail\.com|online\.htcgsc\.edu\.ph)$/.test(this.form.email_address)) {
                return alert('Please enter a valid Gmail or HTCGSC email address.');
            }

            const phoneValue = this.form.phone_number.replace(/\s+/g, '');
            if (phoneChanged && phoneValue !== '' && !/^(09|\+639)\d{9}$/.test(phoneValue)) {
                return alert('Please enter a valid Philippine mobile number.');
            }

            if (!this.isSelf) {
                this.$dispatch('show-loading-accounts', {
                    message: 'Updating user profile...',
                    userName: personName
                });
            } else if (this.loaderId) {
                const loader = document.getElementById(this.loaderId);
                if (loader) {
                    loader.classList.remove('hidden');
                    loader.classList.add('flex');
                }
            }

            const formData = new FormData(this.$el);

            fetch(this.$el.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                }
            })
            .then(async response => {
                const data = await response.json();

                if (response.ok) {
                    this.$dispatch('notify', { type: 'success', message: data.message });

                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        Object.keys(this.form).forEach(key => {
                            if (key in this.original) this.original[key] = this.form[key];
                        });
                        this.form.hasNewFile = false;
                        this.form.remove_picture = '0';

                        if (this.modal) {
                            this.$dispatch('close-modal', { id: @js($id) });
                        }

                        if (!this.isSelf) {
                            this.$dispatch('hide-loading-accounts');
                        } else if (this.loaderId) {
                            const loader = document.getElementById(this.loaderId);
                            if (loader) {
                                loader.classList.remove('flex');
                                loader.classList.add('hidden');
                            }
                        }

                        window.Livewire?.dispatch('refreshList');
                    }
                } else {
                    if (!this.isSelf) {
                        this.$dispatch('hide-loading-accounts');
                    } else if (this.loaderId) {
                        const loader = document.getElementById(this.loaderId);
                        if (loader) {
                            loader.classList.remove('flex');
                            loader.classList.add('hidden');
                        }
                    }

                    const errorMessages = response.status === 422 ? Object.values(data.errors).flat().join(' ') : (data.message || 'An unexpected error occurred.');
                    this.$dispatch('notify', { type: 'error', message: errorMessages });
                }
            })
            .catch(() => {
                if (!this.isSelf) {
                    this.$dispatch('hide-loading-accounts');
                } else if (this.loaderId) {
                    const loader = document.getElementById(this.loaderId);
                    if (loader) {
                        loader.classList.remove('flex');
                        loader.classList.add('hidden');
                    }
                }
                this.$dispatch('notify', { type: 'error', message: 'Connection lost. Please try again.' });
            });
        }
    }" x-init="init()" @submit.prevent="submit()" x-cloak>
    @csrf
    @method('PUT')

    <input type="hidden" name="remove_picture" x-model="form.remove_picture">

    <div class="flex justify-center items-center gap-6 mb-4 pb-4 border-slate-100 dark:border-slate-700">
        <div class="relative group">
            <div :class="photoDirty ? 'border-orange-400 bg-orange-50 dark:bg-orange-900/20' : 'border-gray-400 dark:border-gray-600 bg-slate-50 dark:bg-slate-900'" class="h-[8rem] w-[8rem] rounded-2xl overflow-hidden border-2 shadow-sm transition-colors duration-300">
                <template x-if="previewUrl">
                    <img :src="previewUrl" class="w-full h-full object-cover">
                </template>

                <template x-if="!previewUrl">
                    <div class="w-full h-full flex items-center justify-center text-slate-300 dark:text-slate-600">
                        <i class="fas fa-user-circle text-7xl"></i>
                    </div>
                </template>
            </div>

            <template x-if="previewUrl">
                <button type="button" @click="removeImage()" class="absolute -bottom-2 -right-2 bg-red-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-trash-can text-sm"></i>
                </button>
            </template>

            <template x-if="!previewUrl">
                <label class="absolute -bottom-2 -right-2 bg-blue-600 text-white w-8 h-8 flex items-center justify-center rounded-lg cursor-pointer hover:scale-110 transition-transform shadow-md">
                    <i class="fas fa-pencil text-sm"></i>
                    <input type="file" name="profilePicture" id="profilePictureFileInput" class="hidden" accept="image/*" @change="previewImage($event)">
                </label>
            </template>
        </div>

        <div class="ml-4">
            <h2 class="text-[1.5rem] font-bold text-slate-800 dark:text-white transition-colors duration-300">User Profile Settings</h2>
            <p class="text-base text-slate-500 dark:text-slate-400 mt-1 font-medium transition-colors duration-300">Manage the information of your user account.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-x-6 gap-y-4">
        <div class="space-y-1 md:col-span-1">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Last Name <span class="text-red-500">*</span></label>

            <div class="relative flex items-center">
                <i class="fas fa-user absolute left-4 text-slate-400"></i>
                <input type="text" id="lastNameInput" name="last_name" x-model="form.last_name" data-original="{{ $person->last_name }}" :class="isDirty('last_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-1">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">First Name <span class="text-red-500">*</span></label>

            <div class="relative flex items-center">
                <i class="fas fa-user absolute left-4 text-slate-400"></i>
                <input type="text" id="firstNameInput" name="first_name" x-model="form.first_name" data-original="{{ $person->first_name }}" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('first_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-1">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Middle Name</label>

            <div class="relative flex items-center">
                <i class="fas fa-user absolute left-4 text-slate-400"></i>
                <input type="text" id="middleNameInput" name="middle_name" x-model="form.middle_name" data-original="{{ $person->middle_name }}" :class="isDirty('middle_name') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
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

                <div x-show="suffixOpen" x-transition x-cloak class="absolute z-50 w-full mt-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden">
                    <div class="grid grid-cols-2 p-1 gap-1">
                        <button type="button" @click="form.suffix = ''; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800" :class="!form.suffix ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-700 dark:text-slate-300'">
                            N / A
                        </button>

                        @foreach(App\Enums\Enums::suffixes() as $value => $label)
                            <button type="button" @click="form.suffix = '{{ $value }}'; suffixOpen = false" class="w-full text-left px-4 py-2 text-lg transition-colors rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800" :class="form.suffix === '{{ $value }}' ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-700 dark:text-slate-300'">
                                {{ $label }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-10 gap-x-6 gap-y-4">
        <div class="space-y-1 md:col-span-6">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Email Address <span class="text-red-500">*</span></label>

            <div class="relative flex items-center">
                <i class="fas fa-envelope absolute left-4 text-slate-400"></i>
                <input type="email" id="emailInput" name="email_address" x-model="form.email_address" data-original="{{ $person->email_address }}" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('email_address') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-4">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Phone Number</label>

            <div class="relative flex items-center">
                <i class="fas fa-phone absolute left-4 text-slate-400"></i>
                <input type="text" id="phoneInput" name="phone_number" x-model="form.phone_number" data-original="{{ $person->phone_number }}" inputmode="tel" @input="sanitize" @blur="sanitize" :class="isDirty('phone_number') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4 mt-2">
        <button type="button" onclick="toggleModal(true)" class="text-lg w-[14rem] flex justify-between items-center px-4 py-2 font-semibold text-blue-600 dark:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all group">
            <i class="fas fa-key mr-2.5 text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform"></i>
            <span>Change Password</span>
        </button>

        <button type="button" @click="resetForm()" :disabled="!anyDirty" class="text-lg w-[12.5rem] flex justify-between items-center px-4 py-2 font-semibold text-orange-600 dark:text-orange-500 hover:bg-orange-100 dark:hover:bg-orange-900/40 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-rotate-left mr-2.5 group-hover:scale-110 group-hover:rotate-[-45deg] transition-transform"></i>
            <span>Reset to Default</span>
        </button>

        <button type="submit" :disabled="!anyDirty" class="text-lg w-[12rem] flex justify-between items-center px-4 py-2 font-semibold text-emerald-600 dark:text-emerald-500 hover:bg-emerald-100 dark:hover:bg-emerald-900/90 rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="fas fa-floppy-disk mr-2.5 opacity-80 group-hover:scale-110 transition-transform"></i>
            <span>Save Changes</span>
        </button>
    </div>
</form>
