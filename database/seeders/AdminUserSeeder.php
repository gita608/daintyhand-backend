<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@daintyhand.com',
            'password' => Hash::make('admin123'),
            'phone' => '+91 98765 43210',
            'is_admin' => true,
        ]);
    }
}
