document.addEventListener('alpine:init', () => {
    Alpine.data('studentProfileForm', (config) => ({
        modal: config.modal,
        show: !config.modal,
        student: {},
        form: {
            student_id: '',
            last_name: '',
            first_name: '',
            middle_name: '',
            suffix: '',
            email_address: '',
            phone_number: '',
        },
        original: {},
        suffixOpen: false,

        init() {
            if (this.modal) this.show = true;

            window.addEventListener('open-modal', (event) => {
                if (event.detail.id !== config.formId) return;

                const { student } = event.detail;
                this.student = student;
                const { person } = student;

                this.form = {
                    student_id: student.student_id,
                    last_name: person.last_name,
                    first_name: person.first_name,
                    middle_name: person.middle_name || '',
                    suffix: person.suffix || '',
                    email_address: person.email_address,
                    phone_number: person.phone_number || '',
                };

                this.original = { ...this.form };
                this.show = true;
            });
        },

        isDirty(field) {
            return this.form[field] !== this.original[field];
        },

        get anyDirty() {
            return Object.keys(this.form).some((field) => this.isDirty(field));
        },

        resetForm() {
            this.form = { ...this.original };
        },

        sanitize() {
            this.form.first_name = this.form.first_name.replace(/\s/g, '');
            this.form.phone_number = this.form.phone_number.replace(/[^0-9+]/g, '');
        },

        async submit() {
            const { first_name, middle_name, last_name, suffix } = this.form;
            const personName = [first_name, middle_name, last_name, suffix].filter(Boolean).join(' ');
            window.showLoading(true, 'Updating student profile...', personName);

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

                if (!response.ok) {
                    const errorMessages = response.status === 422 ? Object.values(data.errors).flat().join(' ') : data.message || 'An unexpected error occurred.';
                    throw new Error(errorMessages);
                }

                this.original = { ...this.form };
                window.dispatchEvent(new CustomEvent('close-modal', { detail: { id: config.formId } }));
                window.notify('success', data.message);
                window.Livewire?.dispatch('refreshList');
            } catch (error) {
                window.notify('error', error.message || 'Connection lost. Please try again.');
            } finally {
                window.showLoading(false);
            }
        },
    }));
});
