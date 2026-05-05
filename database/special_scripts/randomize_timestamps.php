<?php

use Illuminate\{Database\Migrations\Migration, Support\Carbon, Support\Facades\DB};

return new class extends Migration {
    public function up(): void
    {
        $appointments = DB::table('appointments')->get();

        foreach ($appointments as $appointment) {
            $randomDays = rand(0, 30);
            $randomHours = rand(0, 23);
            $randomMinutes = rand(0, 59);
            $randomSeconds = rand(0, 59);

            $randomDate = Carbon::now()->subDays($randomDays)->subHours($randomHours)->subMinutes($randomMinutes)->subSeconds($randomSeconds);

            DB::table('appointments')->where('appointment_id', $appointment->appointment_id)->update(['created_at' => $randomDate, 'updated_at' => $randomDate]);
        }
    }

    public function down(): void
    {
        DB::table('appointments')->update(['created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
};
