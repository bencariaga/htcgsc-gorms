<?php

// browsershot.php

return [
    /*
    |--------------------------------------------------------------------------
    | Spatie Browsershot
    |--------------------------------------------------------------------------
    |
    | Convert HTML to an image, PDF or string.
    | Render web pages to an image or PDF with Puppeteer.
    |
    */

    'chromium_arguments' => [
        'user-data-dir' => storage_path('app/browsershot-cache'),
        'disable-2d-canvas-clip-aa',
        'disable-background-networking',
        'disable-background-timer-throttling',
        'disable-backgrounding-occluded-windows',
        'disable-breakpad',
        'disable-canvas-aa',
        'disable-client-side-phishing-detection',
        'disable-component-update',
        'disable-default-apps',
        'disable-dev-shm-usage',
        'disable-domain-reliability',
        'disable-extensions',
        'disable-gpu',
        'disable-hang-monitor',
        'disable-infobars',
        'disable-ipc-flooding-protection',
        'disable-notifications',
        'disable-popup-blocking',
        'disable-prompt-on-repost',
        'disable-renderer-backgrounding',
        'disable-setuid-sandbox',
        'disable-sync',
        'disable-web-security',
        'force-color-profile=srgb',
        'metrics-recording-only',
        'mute-audio',
        'no-first-run',
        'no-sandbox',
        'no-zygote',
        'password-store=basic',
        'proxy-bypass-list=*',
        'proxy-server="direct://"',
        'single-process',
        'use-mock-keychain',
    ],
];
