<?php

namespace App\Support;

use Illuminate\Log\Logger as IlluminateLogger;
use Monolog\{Formatter\LineFormatter, Handler\FormattableHandlerInterface, Logger as MonologLogger};

class VerticalFormatter
{
    public const LOG_FORMAT = '[%datetime%] %env%.%level_name%: %message%';

    public function __invoke(IlluminateLogger $logger)
    {
        $EOL = "\n";
        $appEnv = config('app.env');
        $format = self::LOG_FORMAT . "{$EOL}%context%{$EOL}";
        $format = str($format)->replace('%env%', $appEnv);

        $monolog = $logger->getLogger();

        if (!$monolog instanceof MonologLogger) {
            return;
        }

        foreach ($monolog->getHandlers() as $handler) {
            if (!$handler instanceof FormattableHandlerInterface) {
                continue;
            }

            $formatter = new LineFormatter($format, 'Y-m-d H:i:s', true, true);
            $formatter->setJsonPrettyPrint(true);
            $handler->setFormatter($formatter);
        }
    }
}
