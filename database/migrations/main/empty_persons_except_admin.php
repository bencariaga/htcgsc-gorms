<?php

use Illuminate\{Database\Migrations\Migration, Support\Facades\DB};

return new class extends Migration {
    public function up(): void
    {
        DB::table('students')->delete();
        DB::table('users')->where('person_id', '!=', 1)->delete();
        DB::table('persons')->where('person_id', '!=', 1)->delete();
    }
};
