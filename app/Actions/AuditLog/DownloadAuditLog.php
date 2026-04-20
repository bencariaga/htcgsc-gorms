<?php

namespace App\Actions\AuditLog;

use Opcodes\LogViewer\Facades\LogViewer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class DownloadAuditLog
{
    public function handle(string $fileName): BinaryFileResponse
    {
        $file = LogViewer::getFile($fileName);
        abort_if(!$file, 404);

        return response()->download($file->path);
    }
}
