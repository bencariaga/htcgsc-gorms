<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    public static function execute(string $table, string $primaryKey): int
    {
        return (DB::table($table)->max($primaryKey) ?? 0) + 1;
    }
}
