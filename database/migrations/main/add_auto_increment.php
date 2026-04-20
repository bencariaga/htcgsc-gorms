<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $header) {
            $header->integer('appointment_id', true)->change();
        });

        Schema::table('persons', function (Blueprint $header) {
            $header->integer('person_id', true)->change();
        });

        Schema::table('referrals', function (Blueprint $header) {
            $header->integer('referral_id', true)->change();
        });

        Schema::table('referrers', function (Blueprint $header) {
            $header->integer('referrer_id', true)->change();
        });

        Schema::table('students', function (Blueprint $header) {
            $header->integer('student_id', true)->change();
        });

        Schema::table('users', function (Blueprint $header) {
            $header->integer('user_id', true)->change();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $header) {
            $header->integer('appointment_id', false)->change();
        });

        Schema::table('persons', function (Blueprint $header) {
            $header->integer('person_id', false)->change();
        });

        Schema::table('referrals', function (Blueprint $header) {
            $header->integer('referral_id', false)->change();
        });

        Schema::table('referrers', function (Blueprint $header) {
            $header->integer('referrer_id', false)->change();
        });

        Schema::table('students', function (Blueprint $header) {
            $header->integer('student_id', false)->change();
        });

        Schema::table('users', function (Blueprint $header) {
            $header->integer('user_id', false)->change();
        });
    }
};
