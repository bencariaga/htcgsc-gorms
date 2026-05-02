const getChangedFields = () => {
    const mapping = {
        firstNameInput: 'first name',
        lastNameInput: 'last name',
        middleNameInput: 'middle name',
        suffixHiddenInput: 'suffix',
        emailInput: 'email address',
        phoneInput: 'phone number',
    };

    return Object.entries(mapping)
        .filter(([id]) => isChanged(el(id)))
        .map(([, label]) => label);
};

window.toggleModal = (show) => {
    const modal = el('passwordModal');
    if (!modal) return;

    if (!show) {
        modal.classList.replace('flex', 'hidden');
        return;
    }

    const changed = getChangedFields();

    if (changed.length > 0) {
        const formatter = new Intl.ListFormat('en', { style: 'long', type: 'conjunction' });
        return alert(`You cannot change your password while changing your ${formatter.format(changed)}.`);
    }

    modal.classList.replace('hidden', 'flex');
};

const handlePasswordSubmit = (event) => {
    const modal = el('passwordModal');
    if (modal) modal.classList.replace('flex', 'hidden');

    const loader = el('loadingPassword');
    if (loader) {
        loader.classList.replace('hidden', 'flex');
    }
};

window.addEventListener('pageshow', (e) => {
    if (!e.persisted) return;

    ['loadingPassword', 'loadingProfile'].forEach((id) => {
        const loader = el(id);
        if (loader) {
            loader.classList.replace('flex', 'hidden');
        }
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
            const basicFields = ['last_name', 'first_name', 'middle_name', 'suffix', 'email_address', 'phone_number'];
            return basicFields.some((field) => this.isDirty(field)) || this.photoDirty;
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
            Object.keys(this.original).forEach((key) => {
                this.form[key] = this.original[key];
            });

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

        async submit() {
            const { last_name, first_name, middle_name, suffix, email_address, phone_number } = this.form;
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
                    { n: 'first name', v: first_name.trim() },
                    { n: 'middle name', v: middle_name.trim() },
                    { n: 'last name', v: last_name.trim() },
                ]
                    .filter((f) => f.v && f.v.length < 2)
                    .map((f) => f.n);

                if (names.length > 0) {
                    return alert(`The ${formatter.format(names)} ${names.length > 1 ? 'must all' : 'must'} be at least 2 characters long.`);
                }
            }

            if (emailChanged && !/^[a-zA-Z0-9._%+-]+@(gmail\.com|online\.htcgsc\.edu\.ph)$/.test(email_address)) {
                return alert('Please enter a valid Gmail or HTCGSC email address.');
            }

            const phoneValue = phone_number.replace(/\s+/g, '');
            if (phoneChanged && phoneValue !== '' && !/^(09|\+639)\d{9}$/.test(phoneValue)) {
                return alert('Please enter a valid Philippine mobile number.');
            }

            const personName = [first_name, middle_name, last_name, suffix].filter(Boolean).join(' ');
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

                window.notify('success', data.message);

                if (data.redirect) {
                    window.location.href = data.redirect;
                    return;
                }

                Object.keys(this.form).forEach((key) => {
                    if (key in this.original) this.original[key] = this.form[key];
                });

                this.form.hasNewFile = false;
                this.form.remove_picture = '0';

                if (this.modal) {
                    window.dispatchEvent(new CustomEvent('close-modal', { detail: { id: config.formId } }));
                }

                this.showLoader(false);
                window.Livewire?.dispatch('refreshList');
            } catch (error) {
                this.showLoader(false);
                const msg = error.errors ? Object.values(error.errors).flat().join(' ') : error.message || 'Connection lost. Please try again.';
                window.notify('error', msg);
            }
        },

        showLoader(show, name = '') {
            if (!this.isSelf) {
                window.showLoading(show, 'Updating user profile...', name);
                return;
            }

            const loader = el(this.loaderId);

            loader?.classList.toggle('hidden', !show);
            loader?.classList.toggle('flex', show);
        },
    }));

    Alpine.data('userPasswordModal', (hasPasswordErrors) => ({
        showErrors: hasPasswordErrors,
        init() {
            if (this.showErrors) {
                setTimeout(() => (this.showErrors = false), 5000);
            }
        },
    }));
});

document.addEventListener('DOMContentLoaded', () => {
    el('passwordForm')?.addEventListener('submit', handlePasswordSubmit);
});
