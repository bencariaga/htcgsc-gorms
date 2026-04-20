<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'person_id')) {
                $table->foreignId('person_id')->nullable()->after('referral_id')->constrained('persons', 'person_id')->onDelete('cascade');
            }

            $table->index(['appointment_date', 'appointment_time']);
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'person_id')) {
                $table->dropForeign(['person_id']);
                $table->dropColumn('person_id');
            }

            $table->dropIndex(['appointment_date', 'appointment_time']);
        });
    }
};
