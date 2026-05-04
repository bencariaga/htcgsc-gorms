document.addEventListener('alpine:init', () => {
    Alpine.data('reportForm', (config) => ({
        form: {},
        initialForm: {},
        isSelected: config.isSelected,
        requiredFields: config.fieldKeys,

        init() {
            this.setupForm(config.preloaded || config.initial);
        },

        setupForm(data) {
            const defaultForm = {
                title: '',
                start_date: '',
                end_date: '',
                data_category: '',
                file_output_format: 'pdf',
                report_id: null,
            };

            const sourceData = data ? JSON.parse(JSON.stringify(data)) : defaultForm;

            this.form = { ...defaultForm, ...sourceData };
            this.initialForm = JSON.parse(JSON.stringify(this.form));
        },

        isFieldDirty(field) {
            return JSON.stringify(this.form[field]) !== JSON.stringify(this.initialForm[field]);
        },

        anyFieldDirty() {
            return Object.keys(this.form).some((key) => key !== 'report_id' && this.isFieldDirty(key));
        },

        allFieldsValid() {
            const hasRequiredFields = this.requiredFields.every((key) => this.form[key] && this.form[key].toString().trim() !== '');
            const hasFormat = !!this.form.file_output_format;
            const datesAreValid = this.form.start_date && this.form.end_date ? this.form.start_date <= this.form.end_date : true;
            return hasRequiredFields && hasFormat && datesAreValid;
        },

        canDisableAction(label) {
            const action = label.toLowerCase();

            if (action === 'reset to default') return !this.anyFieldDirty();
            if (action === 'download report') return !this.isSelected || this.anyFieldDirty();
            if (action === 'generate report' || action === 'regenerate report') {
                if (!this.allFieldsValid()) return true;
                if (this.isSelected && !this.anyFieldDirty()) return true;
                return false;
            }

            return false;
        },

        resetToDefault() {
            this.form = JSON.parse(JSON.stringify(this.initialForm));
        },

        handleReportLoaded(data) {
            const isDataValid = !!data;
            this.setupForm(isDataValid ? data : config.initial);
            this.isSelected = isDataValid;

            window.Alpine.nextTick(() => {
                this.isSubmitting = false;
            });
        },
    }));
});
