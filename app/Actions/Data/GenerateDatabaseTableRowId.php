<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    public static function execute(string $table, string $primaryKey): int
    {
        $id = DB::table("{$table} as t1")
            ->selectRaw("t1.{$primaryKey} + 1 as next_id")
            ->leftJoin("{$table} as t2", "t1.{$primaryKey}", '=', DB::raw("t2.{$primaryKey} - 1"))
            ->whereNull("t2.{$primaryKey}")
            ->orderBy("t1.{$primaryKey}")
            ->value("t1.{$primaryKey} + 1");

        if (!$id && DB::table($table)->where($primaryKey, 1)->doesntExist()) {
            return 1;
        }

        return $id ?? 1;
    }
}
