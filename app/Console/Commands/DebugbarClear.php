<?php

namespace App\Console\Commands;

use App\Traits\Miscellaneous\BaseCommandTrait;
use Fruitcake\LaravelDebugbar\{Console\ClearCommand, LaravelDebugbar};
use Illuminate\Support\Facades\File;
use InvalidArgumentException;

class DebugbarClear extends ClearCommand
{
    use BaseCommandTrait;

    /** @var string */
    protected $signature = 'debugbar:clear';

    public static function clear(): void
    {
        $path = storage_path('debugbar');

        if (File::isDirectory($path)) {
            File::cleanDirectory($path);
        }
    }

    public function handle(LaravelDebugbar $debugbar): void
    {
        $this->components->info('Clearing Debugbar storage files.');

        $this->components->task('debugbar', function () use ($debugbar) {
            static::clear();

            $debugbar->boot();

            $storage = $debugbar->getStorage();

            if (!$storage) {
                return;
            }

            try {
                $storage->clear();
            } catch (InvalidArgumentException $e) {
                if (str($e->getMessage())->doesntContain('does not exist')) {
                    throw $e;
                }
            }
        });

        $this->newLine();
    }
}
