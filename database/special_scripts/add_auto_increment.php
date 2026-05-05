<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        foreach ($this->tables() as $table) {
            Schema::table($table, function (Blueprint $header) use ($table) {
                $header->integer(str($table)->singular()->slug('_') . '_id', true)->change();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables() as $table) {
            Schema::table($table, function (Blueprint $header) use ($table) {
                $header->integer(str($table)->singular()->slug('_') . '_id', false)->change();
            });
        }
    }

    private function tables(): array
    {
        return ['appointments', 'persons', 'referrals', 'referrers', 'students', 'users'];
    }
};
