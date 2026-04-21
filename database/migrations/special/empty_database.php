<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\DB, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        foreach (Schema::getTables() as $table) {
            $tableName = $table['name'] ?? $table->name;

            if (!str($tableName)->startsWith('pma__')) {
                DB::table($tableName)->truncate();
            }
        }

        if (DB::table('migrations')->where('migration', 'nuke_database')->exists()) {
            DB::table('migrations')->where('migration', 'nuke_database')->delete();
        }

        Schema::enableForeignKeyConstraints();

        exit(0);
    }
};
