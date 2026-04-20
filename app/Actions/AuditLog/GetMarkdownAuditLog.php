<?php

namespace App\Actions\AuditLog;

use App\Support\LogToMarkdownConverter;

class GetMarkdownAuditLog
{
    public function __construct(protected PrepareAuditLogData $prepareData) {}

    public function handle(mixed $item): string
    {
        $data = $this->prepareData->handle($item);
        $converter = new LogToMarkdownConverter;

        return $converter->convert($data['item']);
    }
}
