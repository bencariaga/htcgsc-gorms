<?php

use App\Enums\{DataCategory, FileOutputFormat};
use Illuminate\{Database\Migrations\Migration, Database\Schema\Blueprint, Support\Facades\Schema};

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->integer('report_id')->primary();
            $table->string('title', 20);
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('data_category', DataCategory::values());
            $table->enum('file_output_format', FileOutputFormat::values());
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
