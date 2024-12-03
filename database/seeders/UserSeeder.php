<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate(); // Clear existing data

        User::create([
            'name' => 'Test User 1',
            'email' => 'test1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a secure password
            'remember_token' => \Str::random(10),
        ]);

        User::create([
            'name' => 'Test User 2',
            'email' => 'test2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a secure password
            'remember_token' => \Str::random(10),
        ]);

        User::create([
            'name' => 'Test User 3',
            'email' => 'test3@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // Use a secure password
            'remember_token' => \Str::random(10),
        ]);

    }
}
