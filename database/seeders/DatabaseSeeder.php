<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::truncate();
        \App\Models\Vacation::truncate();

        \App\Models\User::create([
            'name' => "admin",
            'email' => "admin@test.ru",
            'email_verified_at' => now(),
            'is_admin' => true,
            'password' => '12345678', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::create([
            'name' => "peter",
            'email' => "peter@test.ru",
            'email_verified_at' => now(),
            'is_admin' => false,
            'password' => '12345678', // password
            'remember_token' => Str::random(10),
        ]);

        \App\Models\User::factory(10)->create();
        \App\Models\Vacation::factory(25)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
