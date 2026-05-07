<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->active()->administrator()->create();
        User::factory()->active()->count(10)->create();
        User::factory()->count(19)->create();
    }
}
