const el = (id) => document.getElementById(id);

const isChanged = (input) => {
    if (!input) return false;
    const current = input.value.trim();
    const original = input.getAttribute('data-original') || '';
    return current !== original;
};

setInterval(
    async () => {
        try {
            const response = await fetch('/refresh-csrf');
            if (!response.ok) return;

            const { token } = await response.json();
            if (!token) return;

            document.querySelector('meta[name="csrf-token"]')?.setAttribute('content', token);
            document.querySelectorAll('input[name="_token"]').forEach((input) => (input.value = token));
        } catch (e) {
            console.error('Session refresh encountered a network error.');
        }
    },
    10 * 60 * 1000,
);

window.addEventListener('pageshow', () => {
    document.querySelectorAll('input:not([type="hidden"]), textarea, select').forEach((input) => {
        if (!input.value) return;
        ['input', 'change'].forEach((type) => input.dispatchEvent(new Event(type, { bubbles: true })));
    });
});

window.notify = (type, message) => {
    window.dispatchEvent(new CustomEvent('notify', { detail: { type, message } }));
};

window.showLoading = (show, message = '', userName = '') => {
    const eventName = show ? 'show-loading-accounts' : 'hide-loading-accounts';
    window.dispatchEvent(new CustomEvent(eventName, { detail: { message, userName } }));
};

window.copyToClipboard = async (content, successCallback) => {
    try {
        if (!navigator.clipboard || !window.isSecureContext) {
            fallbackCopy(content, successCallback);
            return;
        }

        await navigator.clipboard.writeText(content);
        successCallback?.();
    } catch (err) {
        console.error('Copy failed', err);
    }
};

const fallbackCopy = (content, successCallback) => {
    const textArea = document.createElement('textarea');
    textArea.value = content;

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
        successCallback?.();
    } catch (err) {
        console.error('Fallback copy failed', err);
    } finally {
        document.body.removeChild(textArea);
    }
};
