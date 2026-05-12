<?php

namespace App\Actions\Data;

use Illuminate\Support\Facades\DB;

class GenerateDatabaseTableRowId
{
    protected static array $cache = [];

    public static function execute(string $table, string $primaryKey): int
    {
        if (!isset(self::$cache[$table])) {
            self::$cache[$table] = DB::table($table)->pluck($primaryKey)->sort()->values()->toArray();
        }

        $nextId = 1;

        foreach (self::$cache[$table] as $id) {
            if ($id > $nextId) {
                break;
            }

            $nextId = $id + 1;
        }

        self::$cache[$table][] = $nextId;
        sort(self::$cache[$table]);

        return $nextId;
    }

    public static function clearCache(?string $table = null): void
    {
        if ($table) {
            unset(self::$cache[$table]);

            return;
        }

        self::$cache = [];
    }
}
