<?php

use App\Models\Student;
use Illuminate\Database\Migrations\Migration;
use Staudenmeir\LaravelMergedRelations\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::createMergeView('all_activities', [(new Student)->referrals(), (new Student)->appointments()]);
    }

    public function down(): void
    {
        Schema::dropViewIfExists('all_activities');
    }
};
