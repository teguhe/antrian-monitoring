<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@antrian.local',
            'password' => 'admin123',
            'role' => 'superadmin',
            'is_active' => true
        ]);
    }
}
