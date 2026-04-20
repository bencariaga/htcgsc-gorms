<?php

// log-viewer.php

use Opcodes\LogViewer\Http\Middleware\{AuthorizeLogViewer, EnsureFrontendRequestsAreStateful};

return [
    /*
    |--------------------------------------------------------------------------
    | Log Viewer Route Prefix
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Log Viewer will be accessible from.
    |
    */

    'route_domain' => null,
    'route_path' => 'log-viewer',

    /*
    |--------------------------------------------------------------------------
    | Log Viewer Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Log Viewer route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['web', AuthorizeLogViewer::class],
    'api_middleware' => [EnsureFrontendRequestsAreStateful::class, AuthorizeLogViewer::class],

    /*
    |--------------------------------------------------------------------------
    | Include Files
    |--------------------------------------------------------------------------
    |
    | This option determines which log files should be included in the viewer.
    | You can specify specific files or use wildcards.
    |
    */

    'include_files' => ['*.log'],
    'exclude_files' => [],

    /*
    |--------------------------------------------------------------------------
    | Shorthand Log Names
    |--------------------------------------------------------------------------
    |
    | If you have long log file names, you can define shorthands here.
    |
    */

    'shorthands' => [],

    /*
    |--------------------------------------------------------------------------
    | Speed and Performance
    |--------------------------------------------------------------------------
    |
    | Log Viewer can index your logs to make searching faster.
    |
    */

    'lazy_indexing' => true,
    'max_log_size' => 1024 * 1024 * 50, // 50MB
];
