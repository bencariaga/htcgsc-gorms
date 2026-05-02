<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use SplFileInfo;

class StorageUnlink extends BaseCommand
{
    protected $signature = 'storage:unlink';

    public function handle(): void
    {
        $links = [public_path('storage') => storage_path('app/public')];
        $excluded = collect(['.gitignore']);

        foreach ($links as $path => $target) {
            $file = new SplFileInfo($path);

            if ($excluded->contains($file->getBasename())) {
                continue;
            }

            if (!$file->isLink() && !File::exists($path)) {
                $this->components->error("The [$path] link does not exist.");

                continue;
            }

            File::delete($path);
            $this->components->info("The [$path] link has been disconnected from [$target].");
        }
    }
}
