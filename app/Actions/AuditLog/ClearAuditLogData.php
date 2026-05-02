<?php

namespace App\Actions\AuditLog;

use Illuminate\Support\Facades\{Cache, File};

class ClearAuditLogData
{
    public function clearCache(mixed $selectedFile): void
    {
        if ($selectedFile) {
            Cache::forget("audit_logs_{$selectedFile->identifier}");
        }
    }

    public function clearMismatchedLoggingFiles(): void
    {
        $isSingle = config('logging.default') === 'single';
        collect(File::files(storage_path('logs')))->filter(fn ($file) => $isSingle xor ($file->getFilename() === 'laravel.log'))->each(fn ($file) => File::delete($file->getPathname()));
    }
}
