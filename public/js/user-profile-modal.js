document.addEventListener('alpine:init', () => {
    Alpine.data('userProfileModal', (id) => ({
        show: false,
        user: {},
        form: {
            user_id: '',
            lastName: '',
            firstName: '',
            middleName: '',
            suffix: '',
            email: '',
            phoneNumber: '',
            remove_picture: '0',
            hasNewFile: false
        },
        original: {},
        previewUrl: '',
        suffixOpen: false,

        init() {
            window.addEventListener('open-modal', (event) => {
                if (event.detail.id === id) {
                    this.user = event.detail.user;
                    const person = this.user.person;

                    this.form = {
                        user_id: this.user.user_id,
                        lastName: person.last_name,
                        firstName: person.first_name,
                        middleName: person.middle_name || '',
                        suffix: person.suffix || '',
                        email: person.email_address,
                        phoneNumber: person.phone_number || '',
                        remove_picture: '0',
                        hasNewFile: false
                    };

                    this.original = { ...this.form };
                    this.previewUrl = this.user.profile_picture ? `/storage/${this.user.profile_picture}` : '';
                    this.show = true;
                }
            });
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
            const fileInput = document.getElementById(`profilePictureFileInput_${id}`);
            if (fileInput) fileInput.value = '';
        },

        resetForm() {
            this.form = { ...this.original };
            this.form.hasNewFile = false;
            this.form.remove_picture = '0';
            this.previewUrl = this.user.profile_picture ? `/storage/${this.user.profile_picture}` : '';
            const fileInput = document.getElementById(`profilePictureFileInput_${id}`);
            if (fileInput) fileInput.value = '';
        },

        sanitize() {
            this.form.firstName = this.form.firstName.replace(/\s/g, '');
            this.form.phoneNumber = this.form.phoneNumber.replace(/[^0-9+]/g, '');
        },

        submit() {
            this.show = false;

            this.$dispatch('show-loading-accounts', {
                message: 'Updating user profile...',
                userName: [this.form.firstName, this.form.middleName, this.form.lastName, this.form.suffix].filter(Boolean).join(' '),
            });

            const formData = new FormData(this.$el);
            // Ensure the correct method is sent for PUT emulation
            formData.append('_method', 'PUT');

            fetch(this.$el.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(async response => {
                const data = await response.json();

                if (response.ok) {
                    this.original = { ...this.form };
                    this.$dispatch('notify', { type: 'success', message: data.message });
                    window.Livewire.dispatch('refreshList');
                } else {
                    this.show = true;
                    const errorMessages = response.status === 422 ? Object.values(data.errors).flat().join(' ') : (data.message || 'An unexpected error occurred.');

                    this.$dispatch('notify', {
                        type: 'error',
                        message: errorMessages
                    });
                }
            })
            .catch(() => {
                this.show = true;
                this.$dispatch('notify', { type: 'error', message: 'Connection lost. Please try again.' });
            })
            .finally(() => {
                this.$dispatch('hide-loading-accounts');
            });
        }
    }));
});
