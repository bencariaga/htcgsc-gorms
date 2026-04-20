@php $profilePicture = $user->profile_picture ? asset("storage/{$user->profile_picture}") : null; @endphp

<form id="profileForm" action="{{ route('user-profile.update', $user->user_id) }}" method="POST"
    enctype="multipart/form-data" class="space-y-6 py-[20px] px-[2rem]" x-data="{
        form: {
            lastName: @js(old('lastName', $person->last_name)),
            firstName: @js(old('firstName', $person->first_name)),
            middleName: @js(old('middleName', $person->middle_name)),
            suffix: @js(old('suffix', $person->suffix ?? '')),
            email: @js(old('email', $person->email_address)),
            phoneNumber: @js(old('phoneNumber', $person->phone_number)),
            remove_picture: '0',
            hasNewFile: false
        },
        original: {
            lastName: @js($person->last_name),
            firstName: @js($person->first_name),
            middleName: @js($person->middle_name),
            suffix: @js($person->suffix ?? ''),
            email: @js($person->email_address),
            phoneNumber: @js($person->phone_number)
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
            const basicFields = ['lastName', 'firstName', 'middleName', 'suffix', 'email', 'phoneNumber'];
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
            this.form.lastName = this.original.lastName;
            this.form.firstName = this.original.firstName;
            this.form.middleName = this.original.middleName;
            this.form.suffix = this.original.suffix;
            this.form.email = this.original.email;
            this.form.phoneNumber = this.original.phoneNumber;

            this.form.hasNewFile = false;
            this.form.remove_picture = '0';
            this.previewUrl = @js($profilePicture);
            const fileInput = document.getElementById('profilePictureFileInput');
            if (fileInput) fileInput.value = '';
        },

        sanitize() {
            this.form.firstName = this.form.firstName.replace(/\s/g, '');
            this.form.phoneNumber = this.form.phoneNumber.replace(/[^0-9+]/g, '');
        }
    }" x-init="init()" x-cloak>
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
                <input type="text" id="lastNameInput" name="lastName" x-model="form.lastName" data-original="{{ $person->last_name }}" :class="isDirty('lastName') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-1">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">First Name <span class="text-red-500">*</span></label>

            <div class="relative flex items-center">
                <i class="fas fa-user absolute left-4 text-slate-400"></i>
                <input type="text" id="firstNameInput" name="firstName" x-model="form.firstName" data-original="{{ $person->first_name }}" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('firstName') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-1">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Middle Name</label>

            <div class="relative flex items-center">
                <i class="fas fa-user absolute left-4 text-slate-400"></i>
                <input type="text" id="middleNameInput" name="middleName" x-model="form.middleName" data-original="{{ $person->middle_name }}" :class="isDirty('middleName') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
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
                <input type="email" id="emailInput" name="email" x-model="form.email" data-original="{{ $person->email_address }}" @keydown.space.prevent @input="sanitize" @blur="sanitize" :class="isDirty('email') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
            </div>
        </div>

        <div class="space-y-1 md:col-span-4">
            <label class="block text-base font-semibold text-slate-700 dark:text-slate-200">Phone Number</label>

            <div class="relative flex items-center">
                <i class="fas fa-phone absolute left-4 text-slate-400"></i>
                <input type="text" id="phoneInput" name="phoneNumber" x-model="form.phoneNumber" data-original="{{ $person->phone_number }}" inputmode="tel" @input="sanitize" @blur="sanitize" :class="isDirty('phoneNumber') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[50px] pl-12 pr-4 py-3 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-emerald-500 transition-all dark:text-white">
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
