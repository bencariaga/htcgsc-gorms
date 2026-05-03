const onNextLivewireCommit = (cb) => {
    const off = window.Livewire.hook('commit', ({ succeed }) => {
        succeed(() => {
            off();
            cb();
        });
    });
};

const getChangedFields = () => {
    const fieldMap = {
        firstNameInput: 'first name',
        lastNameInput: 'last name',
        middleNameInput: 'middle name',
        suffixInput: 'suffix',
        emailAddressInput: 'email address',
        phoneNumberInput: 'phone number',
    };

    return Object.entries(fieldMap)
        .filter(([id]) => isChanged(el(id)))
        .map(([, label]) => label);
};

window.toggleModal = (show) => {
    window.dispatchEvent(new CustomEvent('open-password-modal', { detail: { show } }));
};

const validateNameLength = (form, formatter) => {
    const nameFields = [
        { n: 'first name', v: form.first_name.trim() },
        { n: 'middle name', v: form.middle_name.trim() },
        { n: 'last name', v: form.last_name.trim() },
    ]
        .filter((f) => f.v && f.v.length < 2)
        .map((f) => f.n);

    if (nameFields.length === 0) return null;
    return `The ${formatter.format(nameFields)} ${nameFields.length > 1 ? 'must all' : 'must'} be at least 2 characters long.`;
};

const validateEmail = (email) => {
    if (/^[a-zA-Z0-9._%+-]+@(gmail\.com|online\.htcgsc\.edu\.ph)$/.test(email)) return null;
    return 'Please enter a valid Gmail or HTCGSC email address.';
};

const validatePhone = (phone) => {
    const cleaned = phone.replace(/\s+/g, '');
    if (cleaned === '' || /^(09|\+639)\d{9}$/.test(cleaned)) return null;
    return 'Please enter a valid Philippine mobile number.';
};

window.addEventListener('pageshow', (e) => {
    if (!e.persisted) return;

    ['loadingPassword', 'loadingProfile'].forEach((id) => {
        el(id)?.classList.replace('flex', 'hidden');
    });
});

document.addEventListener('alpine:init', () => {
    Alpine.data('userProfileForm', (config) => ({
        modal: config.modal,
        isSelf: config.isSelf,
        loaderId: config.loaderId,
        form: config.initialForm,
        original: config.originalData,
        previewUrl: config.profilePicture,
        suffixOpen: false,
        isLoaded: false,

        init() {
            if (this.form.suffix === null) this.form.suffix = '';
            if (config.hasErrors) this.resetForm();
            this.$nextTick(() => {
                this.isLoaded = true;
            });
        },

        isDirty(field) {
            return this.form[field] !== this.original[field];
        },

        get photoDirty() {
            return this.form.hasNewFile || this.form.remove_picture === '1';
        },

        get anyDirty() {
            const fields = ['last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'];
            return fields.some((f) => this.isDirty(f)) || this.photoDirty;
        },

        previewImage(event) {
            const file = event.target.files[0];
            if (!file) return;

            this.previewUrl = URL.createObjectURL(file);
            this.form.remove_picture = '0';
            this.form.hasNewFile = true;
        },

        removeImage() {
            this.form.remove_picture = '1';
            this.form.hasNewFile = false;
            this.previewUrl = '';

            const fileInput = el('profilePictureFileInput');
            if (fileInput) fileInput.value = '';
        },

        resetForm() {
            Object.assign(this.form, this.original);
            this.form.hasNewFile = false;
            this.form.remove_picture = '0';
            this.previewUrl = config.profilePicture;

            const fileInput = el('profilePictureFileInput');
            if (fileInput) fileInput.value = '';
        },

        sanitize() {
            this.form.first_name = this.form.first_name.replace(/\s/g, '');
            this.form.phone_number = this.form.phone_number.replace(/[^0-9+]/g, '');
        },

        showLoader(show, name = '') {
            if (!this.isSelf || this.modal) {
                window.showLoading(show, 'Updating user profile...', name);
                return;
            }

            const loader = el(this.loaderId);
            loader?.classList.toggle('hidden', !show);
            loader?.classList.toggle('flex', show);
        },

        async submit() {
            const { last_name, first_name, middle_name, suffix, email_address, phone_number } = this.form;
            const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });
            const nameChanged = ['first_name', 'middle_name', 'last_name', 'suffix'].some((f) => this.isDirty(f));
            const emailChanged = this.isDirty('email_address');
            const phoneChanged = this.isDirty('phone_number');

            if (emailChanged && phoneChanged) {
                return alert('For security reasons, you cannot change your email address and phone number at the same time. Please update them one at a time.');
            }

            if (nameChanged && (emailChanged || phoneChanged)) {
                return alert(`You cannot change your name while changing your ${emailChanged ? 'email address' : 'phone number'}.`);
            }

            if (nameChanged) {
                const nameError = validateNameLength(this.form, formatter);
                if (nameError) return alert(nameError);
            }

            if (emailChanged) {
                const emailError = validateEmail(email_address);
                if (emailError) return alert(emailError);
            }

            if (phoneChanged) {
                const phoneError = validatePhone(phone_number);
                if (phoneError) return alert(phoneError);
            }

            const personName = [first_name, middle_name, last_name, suffix].filter(Boolean).join(' ');

            if (this.modal) {
                window.dispatchEvent(new CustomEvent('close-modal', { detail: { id: config.formId } }));
            }

            this.showLoader(true, personName);

            try {
                const response = await fetch(this.$el.action, {
                    method: 'POST',
                    body: new FormData(this.$el),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    },
                });

                const data = await response.json();
                if (!response.ok) throw data;

                Object.keys(this.form).forEach((key) => {
                    if (key in this.original) this.original[key] = this.form[key];
                });

                this.form.hasNewFile = false;
                this.form.remove_picture = '0';

                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }

                if (window.Livewire) {
                    onNextLivewireCommit(() => {
                        this.showLoader(false);
                        window.notify('success', data.message);
                    });

                    window.Livewire.dispatch('refreshList');
                } else {
                    this.showLoader(false);
                    window.notify('success', data.message);
                }
            } catch (error) {
                this.showLoader(false);
                const msg = error.errors
                    ? Object.values(error.errors)
                          .flatMap((v) => v)
                          .join(' ')
                    : error.message || 'Connection lost. Please try again.';
                window.notify('error', msg);
            }
        },
    }));

    Alpine.data('userPasswordModal', (hasPasswordErrors) => ({
        showErrors: hasPasswordErrors,
        isOpen: hasPasswordErrors,

        init() {
            if (!this.showErrors) return;
            setTimeout(() => {
                this.showErrors = false;
            }, 5000);
        },

        openModal(event) {
            if (!event.detail.show) {
                this.isOpen = false;
                return;
            }

            const changed = getChangedFields();

            if (changed.length > 0) {
                const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });
                alert(`You cannot change your password while changing your ${formatter.format(changed)}.`);
                return;
            }

            this.isOpen = true;
        },

        closeModal() {
            this.isOpen = false;
            this.showErrors = false;
        },

        submitPassword() {
            this.isOpen = false;
            const loader = el('loadingPassword');
            loader?.classList.replace('hidden', 'flex');
        },
    }));
});
