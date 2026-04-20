document.addEventListener('livewire:init', () => {
    const reload = () => window.location.reload();

    Livewire.on('refresh-page', reload);

    Livewire.hook('request', ({ fail }) => {
        fail(({ status, preventDefault }) => {
            if (status === 500) {
                console.warn("Caught a 500 error. Attempting soft refresh...");
                preventDefault();
                Livewire.dispatch('refreshList');
            }
        });
    });
});

async function fetchLogs(fileName = null) {
    try {
        const urlParams = new URLSearchParams(window.location.search);
        const targetFile = fileName || urlParams.get('file');
        const page = urlParams.get('page') || 1;
        const direction = urlParams.get('direction') || 'desc';

        if (!targetFile) {
            console.warn("Fetch aborted: No log file specified.");
            return null;
        }

        const response = await fetch(`/log-viewer/api/logs?file=${targetFile}&page=${page}&direction=${direction}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });

        if (!response.ok) {
            throw new Error(`Server responded with ${response.status}`);
        }

        const data = await response.json();

        return data.logs || data;
    } catch (e) {
        console.error("Graceful fetch failed:", e);
        return null;
    }
}
