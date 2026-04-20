<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::table('referrals', function (Blueprint $blueprint) {
            $blueprint->integer('referrer_id')->unsigned()->after('student_id')->nullable();
            $blueprint->foreign('referrer_id')->references('user_id')->on('users')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('referrals', function (Blueprint $blueprint) {
            $blueprint->dropForeign(['referrer_id']);
            $blueprint->dropColumn('referrer_id');
        });
    }
};
