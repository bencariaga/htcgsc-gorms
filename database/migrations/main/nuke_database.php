<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        $schema = Schema::getSchemaBuilder();

        $schema->dropAllViews();
        $schema->dropAllTables();
        $schema->dropAllTypes();

        Schema::enableForeignKeyConstraints();

        $this->recreateMigrationsTable();
        $this->forgetMe();
    }

    protected function recreateMigrationsTable(): void
    {
        Schema::create('migrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('migration');
            $table->integer('batch');
        });
    }

    protected function forgetMe(): void
    {
        $migrationName = basename(__FILE__, '.php');

        DB::table('migrations')->where('migration', $migrationName)->delete();
    }
};
