<?php

use App\Enums\{AppointmentStatus, AppointmentTime, ReferralType};
use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->integer('appointment_id')->primary();
            $table->integer('referrer_id');
            $table->integer('referral_id');
            $table->integer('person_id')->nullable();
            $table->enum('referral_type', ReferralType::values());
            $table->string('reason');
            $table->date('appointment_date');
            $table->enum('appointment_time', AppointmentTime::values());
            $table->enum('appointment_status', AppointmentStatus::values());
            $table->timestamps();
            $table->foreign('referrer_id')->references('referrer_id')->on('referrers')->onDelete('cascade');
            $table->foreign('referral_id')->references('referral_id')->on('referrals')->onDelete('cascade');
            $table->foreign('person_id')->references('person_id')->on('persons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
