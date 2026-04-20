<?php

namespace App\Actions\GoogleForms;

use Illuminate\Support\{Collection, Facades\File, Number, Str};

class GetLogFiles
{
    public function execute(): Collection
    {
        $directory = storage_path('logs/google-forms');

        return collect(File::exists($directory) ? File::files($directory) : [])->filter(fn ($file) => Str::startsWith($file->getFilename(), 'google-forms-'))->map(fn ($file) => (object) [
            'name' => $file->getFilename(),
            'sizeFormatted' => Number::format($file->getSize() / 1024, 2) . ' KB',
        ])->sortByDesc('name');
    }
}
