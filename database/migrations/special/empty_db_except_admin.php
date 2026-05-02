<?php

use App\Enums\PersonType;
use Illuminate\{Database\Migrations\Migration, Support\Facades\DB, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        collect(Schema::getTables())->each(function ($table) {
            $tableName = $table['name'] ?? $table->name;

            if ($tableName === 'persons') {
                return DB::table('persons')->where('type', '!=', PersonType::Administrator->value)->delete();
            }

            if ($tableName === 'users') {
                return DB::table('users')->whereNotExists(fn ($q) => $q->select(DB::raw(1))->from('persons')->whereColumn('persons.person_id', 'users.person_id')->where('persons.type', PersonType::Administrator->value))->delete();
            }

            if (!str($tableName)->startsWith('pma__')) {
                DB::table($tableName)->truncate();
            }
        });

        if (DB::table('migrations')->where('migration', 'nuke_database')->exists()) {
            DB::table('migrations')->where('migration', 'nuke_database')->delete();
        }

        Schema::enableForeignKeyConstraints();

        exit(0);
    }
};
