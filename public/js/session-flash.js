document.addEventListener('DOMContentLoaded', () => {
    const raw = document.body.getAttribute('data-flash');
    if (!raw) return;

    let flashes;

    try {
        flashes = JSON.parse(raw);
    } catch {
        return;
    }

    const validTypes = ['success', 'error', 'warning', 'info'];

    Object.entries(flashes)
        .filter(([type, message]) => validTypes.includes(type) && message)
        .forEach(([type, message]) => {
            window.dispatchEvent(new CustomEvent('notify', { detail: { type, message } }));
        });
});
