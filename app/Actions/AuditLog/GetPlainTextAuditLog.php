<?php

namespace App\Actions\AuditLog;

class GetPlainTextAuditLog
{
    public function __construct(protected PrepareAuditLogData $prepareData) {}

    public function handle(mixed $item): string
    {
        $data = $this->prepareData->handle($item);

        return "[{$data['date']} {$data['time']}] {$data['level']}: {$data['message']}";
    }
}
