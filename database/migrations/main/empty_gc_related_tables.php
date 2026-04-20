<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\DB};

return new class extends Migration {
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('appointments')->truncate();
        DB::table('referrals')->truncate();
        DB::table('referrers')->truncate();
        DB::table('students')->truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    public function down(): void {}
};
