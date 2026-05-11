document.addEventListener('alpine:init', () => {
    Alpine.store('formPreview', {
        activeSubmission: null,

        load(data) {
            this.activeSubmission = data;
        },

        plain() {
            return JSON.parse(JSON.stringify(this.activeSubmission));
        },
    });

    Alpine.store('download', {
        type: '',
    });

    window.triggerSubmissionLoading = (label) => {
        const data = Alpine.store('formPreview').activeSubmission;
        if (!data) return;

        const name = [data['Last Name (Referral)'] || data['Last Name'], data['First Name (Referral)'] || data['First Name']].filter(Boolean).join(', ');
        const labelMap = {
            'Download as Log': 'Downloading as log...',
            'Download as PDF': 'Downloading as PDF...',
            'Download as Image': 'Downloading as image...',
        };

        const message = labelMap[label] || 'Downloading as ' + label.toLowerCase() + '...';
        window.showLoading(true, message, name);
    };

    window.addEventListener('hide-loading-accounts', () => {
        Alpine.store('download').type = '';
    });
});
