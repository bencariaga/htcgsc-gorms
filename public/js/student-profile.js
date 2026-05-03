const onNextLivewireCommit = (cb) => {
    const off = window.Livewire.hook('commit', ({ succeed }) => {
        succeed(() => {
            off();
            cb();
        });
    });
};

const extractErrorMessage = (data, status) => {
    if (status === 422 && data.errors) {
        return Object.values(data.errors)
            .flatMap((v) => v)
            .join(' ');
    }
    return data.message || 'An unexpected error occurred.';
};

document.addEventListener('alpine:init', () => {
    Alpine.data('studentProfileForm', (config) => ({
        modal: config.modal,
        loaderId: config.loaderId ?? null,
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
            window.addEventListener('open-modal', (event) => {
                if (event.detail.id !== config.formId) return;

                const { student } = event.detail;
                const { person } = student;

                this.student = student;
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
            });
        },

        isDirty(field) {
            return this.form[field] !== this.original[field];
        },

        get anyDirty() {
            return Object.keys(this.form).some((f) => this.isDirty(f));
        },

        resetForm() {
            this.form = { ...this.original };
        },

        sanitize() {
            this.form.first_name = this.form.first_name.replace(/\s/g, '');
            this.form.phone_number = this.form.phone_number.replace(/[^0-9+]/g, '');
        },

        showModalLoader(show) {
            if (!this.loaderId) return;

            const loader = el(this.loaderId);
            if (!loader) return;

            loader.classList.toggle('hidden', !show);
            loader.classList.toggle('flex', show);
        },

        async submit() {
            const { first_name, middle_name, last_name, suffix } = this.form;
            const personName = [first_name, middle_name, last_name, suffix].filter(Boolean).join(' ');

            if (this.modal) {
                this.showModalLoader(true);
            } else {
                window.showLoading(true, 'Updating student profile...', personName);
            }

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
                    throw new Error(extractErrorMessage(data, response.status));
                }

                this.original = { ...this.form };

                if (window.Livewire) {
                    onNextLivewireCommit(() => {
                        if (this.modal) {
                            this.showModalLoader(false);
                        } else {
                            window.showLoading(false);
                        }
                        window.notify('success', data.message);
                    });

                    window.Livewire.dispatch('refreshList');
                } else {
                    if (this.modal) {
                        this.showModalLoader(false);
                    } else {
                        window.showLoading(false);
                    }
                    window.notify('success', data.message);
                }
            } catch (error) {
                if (this.modal) {
                    this.showModalLoader(false);
                } else {
                    window.showLoading(false);
                }

                window.notify('error', error.message || 'Connection lost. Please try again.');
            }
        },
    }));
});
