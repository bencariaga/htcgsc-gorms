<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->nuke();

        Schema::enableForeignKeyConstraints();

        exit(0);
    }

    protected function nuke(): void
    {
        $methods = ['dropAllViews', 'dropAllTables', 'dropAllTypes'];

        foreach ($methods as $method) {
            try {
                Schema::$method();
            } catch (BadMethodCallException|LogicException) {
                //
            }
        }
    }
};
