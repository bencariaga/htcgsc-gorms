<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    public static function execute(string $table, string $primaryKey): int
    {
        $ids = DB::table($table)->pluck($primaryKey)->sort();

        $nextId = 1;

        foreach ($ids as $id) {
            if ($id > $nextId) {
                break;
            }

            $nextId = $id + 1;
        }

        return $nextId;
    }
}
