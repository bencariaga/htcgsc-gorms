<?php

use App\Enums\{PersonSuffix, PersonType};
use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->integer('person_id')->primary();
            $table->enum('type', PersonType::values());
            $table->string('last_name', 20);
            $table->string('first_name', 20);
            $table->string('middle_name', 20)->nullable();
            $table->enum('suffix', PersonSuffix::values())->nullable();
            $table->string('email_address', 60);
            $table->string('phone_number', 11)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
