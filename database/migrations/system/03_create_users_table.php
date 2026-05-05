<?php

use App\Enums\AccountStatus;
use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->unsignedInteger('person_id');
            $table->enum('account_status', AccountStatus::values());
            $table->string('password');
            $table->text('profile_picture')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('person_id')->references('person_id')->on('persons')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
