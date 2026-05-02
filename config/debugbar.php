<?php

// debugbar.php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Debugbar Settings
    |--------------------------------------------------------------------------
    |
    | Debugbar is enabled by default, when debug is set to true in app.php.
    | You can override the value by setting enable to true or false instead of null.
    |
    | You can provide an array of URI's that must be ignored (eg. 'api/*')
    |
     */

    'enabled' => env('DEBUGBAR_ENABLED'),
    'collect_jobs' => false,
    'except' => ['telescope*', 'horizon*', '_boost/browser-logs'],

    /*
    |--------------------------------------------------------------------------
    | DataCollectors
    |--------------------------------------------------------------------------
    |
    | Enable/disable DataCollectors
    |
    */

    'collectors' => [
        'phpinfo' => false,         // Php version
        'messages' => true,          // Messages
        'time' => true,          // Time Datalogger
        'memory' => true,          // Memory usage
        'exceptions' => true,          // Exception displayer
        'log' => true,          // Logs from Monolog (merged in messages if enabled)
        'db' => true,          // Show database (PDO) queries and bindings
        'views' => true,          // Views with their data
        'route' => true,          // Current route information
        'auth' => true,          // Display Laravel authentication status
        'gate' => true,          // Display Laravel Gate checks
        'session' => true,          // Display session data
        'symfony_request' => true,          // Default Request Data
        'mail' => true,          // Catch mail messages
        'laravel' => false,         // Laravel version and environment
        'events' => false,         // All events fired
        'logs' => false,         // Add the latest log messages
        'config' => false,         // Display config settings
        'cache' => false,         // Display cache events
        'models' => true,          // Display models
        'livewire' => true,          // Display Livewire (when available)
        'inertia' => false,         // Display Inertia (when available)
        'jobs' => false,         // Display dispatched jobs
        'pennant' => false,         // Display Pennant feature flags
        'http_client' => false,         // Display HTTP Client requests
    ],

    /*
    |--------------------------------------------------------------------------
    | Extra options
    |--------------------------------------------------------------------------
    |
    | Configure some DataCollectors
    |
     */

    'options' => [
        'db' => [
            'with_params' => true,   // Render SQL with the parameters substituted
            'backtrace' => true,   // Use a backtrace to find the origin of the query in your files.
            'timeline' => false,  // Add the queries to the timeline
            'explain' => ['enabled' => false, 'types' => ['SELECT']],
            'soft_limit' => 100,     // After the soft limit, no parameters/backtrace are captured
            'hard_limit' => 500,     // After the hard limit, queries are ignored
        ],
        'mail' => ['full_log' => false],
        'views' => [
            'timeline' => false,           // Add the views to the timeline
            'data' => false,               // True for all data, 'keys' for only names, false for no parameters.
        ],
        'route' => [
            'label' => true,               // Show complete route on bar
        ],
        'session' => ['SHOW_DATA' => false],
        'symfony_request' => [
            'label' => true,               // Show route on bar
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Inject Debugbar in Response
    |--------------------------------------------------------------------------
    |
    | Usually, the debugbar is added just before </body>, by listening to the
    | Response after the App is done. If you disable this, you have to add them
    | in your template yourself. See http://phpdebugbar.com/docs/rendering.html
    |
     */

    'inject' => true,

    /*
    |--------------------------------------------------------------------------
    | Debugbar route prefix
    |--------------------------------------------------------------------------
    |
    | Sometimes you want to set route prefix to be used by Debugbar to load
    | its resources from. Usually the need comes from misconfigured web server or
    | from trying to overcome bugs like this: http://trac.nginx.org/nginx/ticket/97
    |
     */

    'route_prefix' => '_debugbar',

    /*
    |--------------------------------------------------------------------------
    | Debugbar route domain
    |--------------------------------------------------------------------------
    |
    | By default Debugbar route served from the same domain that request served.
    | To override default domain, specify it as a non-empty value.
     */

    'route_domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Debugbar theme
    |--------------------------------------------------------------------------
    |
    | Switches between light and dark theme. If set to auto it will respect system preferences
    | Possible values: auto, light, dark
     */

    'theme' => 'auto',

    /*
    |--------------------------------------------------------------------------
    | Backtrace stack limit
    |--------------------------------------------------------------------------
    |
    | By default, the Debugbar limits the number of frames returned by the 'debug_backtrace()' function.
    | If you need larger stacktraces, you can increase this number. Setting it to 0 will result in no limit.
     */

    'debug_backtrace_limit' => 50,
];
