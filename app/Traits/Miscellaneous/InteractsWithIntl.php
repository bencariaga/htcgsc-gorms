<?php

namespace App\Traits\Miscellaneous;

use RuntimeException;

trait InteractsWithIntl
{
    protected static function ensureIntlExtensionIsInstalled()
    {
        if (!extension_loaded('intl')) {
            $method = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2)[1]['function'];

            $className = class_basename(static::class);

            throw new RuntimeException("The PHP 'intl' extension is required to use the {$className}::{$method} method.");
        }
    }
}
