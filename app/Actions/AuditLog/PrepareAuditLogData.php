<?php

namespace App\Actions\AuditLog;

use Illuminate\Support\Str;

class PrepareAuditLogData
{
    public function handle(mixed $item): array
    {
        $date = $item->datetime ? $item->datetime->format('m-d-Y') : '';
        $time = $item->datetime ? $item->datetime->format('h:i:s A') : '';

        return [
            'level' => Str::upper((string) ($item->level ?? 'INFO')),
            'date' => $date,
            'time' => $time,
            'datetime' => ($date && $time) ? "{$date} | {$time}" : '',
            'message' => (string) ($item->message ?? ''),
            'raw_text' => (string) ($item->text ?? $item->message ?? ''),
            'item' => $item,
        ];
    }
}
