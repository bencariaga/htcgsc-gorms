setInterval(async () => {
    try {
        const response = await fetch("/refresh-csrf");

        if (!response.ok) {
            return;
        }

        const data = await response.json();
        const token = data.token;

        if (token) {
            document.querySelector('meta[name="csrf-token"]')?.setAttribute('content', token);

            document.querySelectorAll('input[name="_token"]').forEach(input => {
                input.value = token;
            });
        }
    } catch (e) {
        console.error("Session refresh encountered a network error.");
    }
}, 10 * 60 * 1000);

window.addEventListener('pageshow', () => {
    const inputs = document.querySelectorAll('input:not([type="hidden"]), textarea, select');

    inputs.forEach(input => {
        if (input.value) {
            ['input', 'change'].forEach(type =>
                input.dispatchEvent(new Event(type, { bubbles: true }))
            );
        }
    });
});
