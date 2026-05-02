<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Storage;

class CleanLivewireTemp extends BaseCommand
{
    protected $signature = 'livewire:clear';

    public function handle()
    {
        static::clear();
        $this->components->info('Temporary Livewire files cleared successfully!');
    }

    public static function clear(): void
    {
        $storage = Storage::disk('local');
        $path = 'livewire-tmp';

        if ($storage->exists($path)) {
            $files = $storage->allFiles($path);

            foreach ($files as $file) {
                $storage->delete($file);
            }
        }
    }
}
