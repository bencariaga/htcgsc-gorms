document.addEventListener('alpine:init', () => {
    Alpine.store('formPreview', {
        activeSubmission: null,

        load(data) {
            this.activeSubmission = data;
        },
    });

    Alpine.store('download', {
        type: '',
    });
});
