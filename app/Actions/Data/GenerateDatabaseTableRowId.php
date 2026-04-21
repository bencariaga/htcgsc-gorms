<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    public static function execute(string $table, string $primaryKey): int
    {
        $existingIds = DB::table($table)->pluck($primaryKey)->sort()->values();

        if ($existingIds->isEmpty() || $existingIds->first() > 1) {
            return 1;
        }

        foreach ($existingIds as $index => $id) {
            $nextExpectedId = $id + 1;

            if (!$existingIds->has($index + 1) || $existingIds[$index + 1] !== $nextExpectedId) {
                return $nextExpectedId;
            }
        }

        return $existingIds->last() + 1;
    }
}
