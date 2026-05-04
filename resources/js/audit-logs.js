document.addEventListener('alpine:init', () => {
    Alpine.data('auditLogGroup', (message, markdownSource, htmlContent, levelClass, date, time) => ({
        copiedText: false,
        copiedMd: false,

        copy(type) {
            const isText = type === 'text';
            const content = isText ? message : markdownSource;
            const stateKey = isText ? 'copiedText' : 'copiedMd';

            window.copyToClipboard(content, () => {
                this[stateKey] = true;
                window.notify('success', `Audit log in <strong>${isText ? 'plain text' : 'markdown'}</strong> copied to clipboard successfully.`);
                setTimeout(() => (this[stateKey] = false), 3000);
            });
        },

        openModal() {
            window.dispatchEvent(
                new CustomEvent('open-audit-log-modal', {
                    detail: {
                        id: 'audit-log-modal',
                        htmlContent: htmlContent,
                        plainText: message,
                        rawMarkdown: markdownSource,
                        levelClass: levelClass,
                        date: date,
                        time: time,
                    },
                }),
            );
        },
    }));
});
