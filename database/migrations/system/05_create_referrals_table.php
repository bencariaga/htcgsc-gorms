<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->increments('referral_id');
            $table->unsignedInteger('student_id');
            $table->timestamps();
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
