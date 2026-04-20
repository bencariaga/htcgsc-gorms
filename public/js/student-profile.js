document.addEventListener('alpine:init', () => {
    Alpine.data('studentProfileForm', (id) => ({
        show: false,
        student: {},
        form: {
            student_id: '',
            lastName: '',
            firstName: '',
            middleName: '',
            suffix: '',
            email: '',
            phoneNumber: ''
        },
        original: {},
        suffixOpen: false,

        init() {
            window.addEventListener('open-modal', (event) => {
                if (event.detail.id === id) {
                    this.student = event.detail.student;
                    const person = this.student.person;

                    this.form = {
                        student_id: this.student.student_id,
                        lastName: person.last_name,
                        firstName: person.first_name,
                        middleName: person.middle_name || '',
                        suffix: person.suffix || '',
                        email: person.email_address,
                        phoneNumber: person.phone_number || ''
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
            this.form.firstName = this.form.firstName.replace(/\s/g, '');
            this.form.phoneNumber = this.form.phoneNumber.replace(/[^0-9+]/g, '');
        },

        submit() {
            this.show = false;

            this.$dispatch('show-loading-accounts', {
                message: 'Updating student profile...',
                userName: [this.form.firstName, this.form.middleName, this.form.lastName, this.form.suffix].filter(Boolean).join(' '),
            });

            fetch(this.$el.action, {
                method: 'POST',
                body: new FormData(this.$el),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(async response => {
                const data = await response.json();

                if (response.ok) {
                    this.original = { ...this.form };
                    this.$dispatch('notify', { type: 'success', message: data.message });
                    window.Livewire.dispatch('refreshStudentList');
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
