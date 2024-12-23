<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'), // Password terenkripsi
            'role' => 'admin',
        ]);

        // User
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user123'), // Password terenkripsi
            'role' => 'user',
        ]);
    }
}
