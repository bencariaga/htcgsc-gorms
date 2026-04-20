<?php

use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id('archive_id');
            $table->enum('archive_type', ['Student', 'Referral', 'Appointment']);
            $table->dateTime('archived_at');
            $table->timestamps();
        });

        Schema::create('persons', function (Blueprint $table) {
            $table->id('person_id');
            $table->enum('type', ['Administrator', 'Employee', 'Student']);
            $table->string('last_name', 20);
            $table->string('first_name', 20);
            $table->string('middle_name', 20)->nullable();
            $table->enum('suffix', ['Sr.', 'Jr.', 'II', 'III', 'IV', 'V', 'VI'])->nullable();
            $table->string('email_address', 60);
            $table->string('phone_number', 16)->nullable();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade');
            $table->enum('account_status', ['Inactive', 'Active']);
            $table->string('password');
            $table->text('profile_picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id('student_id');
            $table->foreignId('person_id')->constrained('persons', 'person_id')->onDelete('cascade');
            $table->foreignId('archive_id')->nullable()->constrained('archives', 'archive_id')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('referrers', function (Blueprint $table) {
            $table->id('referrer_id');
            $table->foreignId('student_id')->constrained('students', 'student_id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('referrals', function (Blueprint $table) {
            $table->id('referral_id');
            $table->foreignId('student_id')->constrained('students', 'student_id')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->foreignId('referrer_id')->constrained('referrers', 'referrer_id')->onDelete('cascade');
            $table->foreignId('referral_id')->constrained('referrals', 'referral_id')->onDelete('cascade');
            $table->enum('referral_type', ['Yourself', 'Someone Else']);
            $table->text('reason');
            $table->date('appointment_date');
            $table->enum('appointment_time', [
                '8:30 AM - 9:30 AM',
                '9:30 AM - 10:30 AM',
                '10:30 AM - 11:30 AM',
                '1:30 PM - 2:30 PM',
                '2:30 PM - 3:30 PM',
                '3:30 PM - 4:30 PM',
            ]);
            $table->enum('appointment_status', ['Scheduled', 'Completed', 'Cancelled'])->default('Scheduled');
            $table->foreignId('archive_id')->nullable()->constrained('archives', 'archive_id')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('referrals');
        Schema::dropIfExists('referrers');
        Schema::dropIfExists('students');
        Schema::dropIfExists('users');
        Schema::dropIfExists('persons');
        Schema::dropIfExists('archives');
    }
};
