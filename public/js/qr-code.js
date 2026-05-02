document.addEventListener('alpine:init', () => {
    Alpine.data('qrCodeManager', (url) => ({
        copied: false,
        url: url,

        async copyToClipboard() {
            try {
                if (!navigator.clipboard || !window.isSecureContext) {
                    this.fallbackCopy();
                    return;
                }

                await navigator.clipboard.writeText(this.url);
                this.notifySuccess();
            } catch (err) {
                console.error('Copy failed', err);
            }
        },

        fallbackCopy() {
            const textArea = document.createElement('textarea');
            textArea.value = this.url;

            Object.assign(textArea.style, {
                position: 'fixed',
                left: '-999999px',
                top: '-999999px',
            });

            document.body.appendChild(textArea);

            textArea.focus();
            textArea.select();

            try {
                document.execCommand('copy');
                this.notifySuccess();
            } catch (err) {
                console.error('Fallback copy failed', err);
            } finally {
                document.body.removeChild(textArea);
            }
        },

        notifySuccess() {
            this.copied = true;

            this.$dispatch('notify', {
                type: 'success',
                message: 'Google Form link has been <strong>copied to clipboard</strong>!',
            });

            setTimeout(() => (this.copied = false), 3000);
        },
    }));
});
