<?php

return [
    /*
    |--------------------------------------------------------------------------
    | MySQL Protected Databases
    |--------------------------------------------------------------------------
    |
    | These directories in 'C:\xampp\mysql\data' will NEVER be touched
    | by the repair command to prevent data loss.
    |
    */

    'protected' => ['htcgsc_gorms', 'htcgsc_gorms_testing', 'ibdata1'],

    /*
    |--------------------------------------------------------------------------
    | MySQL System Files (Safe to Restore)
    |--------------------------------------------------------------------------
    |
    | These files and directories will be deleted and restored from the
    | 'C:\xampp\mysql\backup' folder during a repair.
    |
    | NOTE: 'ibdata1' is intentionally EXCLUDED to prevent InnoDB
    | data dictionary corruption and "table does not exist" errors.
    |
    */

    'files' => [
        'mysql',
        'performance_schema',
        'phpmyadmin',
        'test',
        'aria_log_control',
        'aria_log.00000001',
        'ib_buffer_pool',
        'ib_logfile0',
        'ib_logfile1',
        'ibtmp1',
        'multi-master.info',
        'my.ini',
        'mysql_error.log',
        'mysql.pid',
    ],
];
