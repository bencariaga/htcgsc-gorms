<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    public static function execute(string $table, string $primaryKey): int
    {
        return DB::table($table)->pluck($primaryKey)->sort()->reduce(fn ($next, $id) => $id == $next ? $id + 1 : $next, 1);
    }
}
