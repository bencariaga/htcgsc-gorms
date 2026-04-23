<?php

// services.php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services. This
    | file provides the location for this type of information, allowing packages
    | to have a conventional file to locate the various service credentials.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Cron Job
    |--------------------------------------------------------------------------
    |
    | It is a web-based task scheduler that executes scheduled HTTP requests.
    | Whether triggered minute-by-minute or once a year, this open-source
    | service allows for flexible automation without requiring access
    | at the server level. It features execution history, status monitoring
    | via badges and pages, and a REST API for programmatic management.
    |
    | See: https://cron-job.org/ and https://github.com/pschlan/cron-job.org/
    |
    */

    'cron_key' => env('CRON_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Spatie Browsershot Binaries
    |--------------------------------------------------------------------------
    |
    | The following are the file locations in the computer represented
    | as environmental variables, provided that the following are
    | installed in the computer: Google Chrome and Node.js.
    |
    | NOTE: This is specifically configured for Windows computers.
    |
    */

    'binaries' => [
        'chrome_path' => env('CHROME_PATH', '/usr/bin/chromium-browser'),
        'node_binary' => env('NODE_BINARY', '/usr/bin/node'),
        'npm_binary' => env('NPM_BINARY', '/usr/bin/npm'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Google Forms
    |--------------------------------------------------------------------------
    |
    | The following are the environmental variables used to make any
    | Google Form function, provided that the following are integrated
    | to the system: Google Apps Script and a cloud-based platform.
    |
    | For the platform, use Ngrok (for local and system testing)
    | or Render (for production and cloud deployment).
    |
    | "form_id" refers to the specific Google Form you want to connect
    | with the system in viewform mode, while "form_id_edit" is its
    | equivalent but in edit mode, one where you can edit the form.
    |
    | See: https://ngrok.com/ and https://render.com/
    |
    */

    'google' => [
        'form_id' => env('GOOGLE_FORM_ID'),
        'form_id_edit' => env('GOOGLE_FORM_ID_EDIT'),
    ],

    /*
    |--------------------------------------------------------------------------
    | PHP Holiday Package
    |--------------------------------------------------------------------------
    |
    | It is a dynamic holiday package for web apps based on PHP and Laravel
    | based on Google API to show the list of holidays in the Philippines.
    |
    | See: https://github.com/San103/HolidayDates-Package/
    |
    */

    'holiday_client' => ['api_key' => env('HOLIDAY_CLIENT_API_KEY')],

    /*
    |--------------------------------------------------------------------------
    | Textbee
    |--------------------------------------------------------------------------
    |
    | It is an open-source SMS gateway. Turn any Android phone into an SMS gateway.
    | The following are the environmental variables used to make TextBee function.
    |
    | See: https://textbee.dev/ and https://github.com/vernu/textbee/
    |
    */

    'textbee' => [
        'base_url' => env('TEXTBEE_BASE_URL'),
        'api_key' => env('TEXTBEE_API_KEY'),
        'device_id' => env('TEXTBEE_DEVICE_ID'),
    ],
];
