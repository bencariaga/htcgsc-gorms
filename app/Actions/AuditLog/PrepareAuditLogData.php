<?php

namespace App\Actions\AuditLog;


class PrepareAuditLogData
{
    public function handle(mixed $item): array
    {
        $date = $item->datetime ? $item->datetime->format('m-d-Y') : '';
        $time = $item->datetime ? $item->datetime->format('h:i:s A') : '';

        return [
            'level' => str((string) ($item->level ?? 'INFO'))->upper(),
            'date' => $date,
            'time' => $time,
            'datetime' => ($date && $time) ? "{$date} | {$time}" : '',
            'message' => (string) ($item->message ?? ''),
            'raw_text' => (string) ($item->text ?? $item->message ?? ''),
            'item' => $item,
        ];
    }
}
