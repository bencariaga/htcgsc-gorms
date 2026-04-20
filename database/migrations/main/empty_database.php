<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\DB, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        $tables = DB::select("SHOW FULL TABLES WHERE Table_type = 'BASE TABLE'");
        $columnName = 'Tables_in_' . env('DB_DATABASE');

        foreach ($tables as $table) {
            $tableName = $table->$columnName;

            if ($tableName !== 'migrations') {
                DB::table($tableName)->truncate();
            }
        }

        Schema::enableForeignKeyConstraints();
    }
};
