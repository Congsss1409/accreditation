<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the user already exists to avoid errors on re-seeding
        if (!User::where('email', 'admin@4107.com')->exists()) {
            User::create([
                'name' => 'Admin 4107',
                'email' => 'admin@4107.com',
                'password' => Hash::make('password'), // Use a secure password
            ]);
        }
    }
}
