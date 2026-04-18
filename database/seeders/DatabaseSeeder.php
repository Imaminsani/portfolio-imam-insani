<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@portfolio.com'],
            [
                'name'     => 'Muhammad Imam Insani',
                'password' => Hash::make('password123'),
            ]
        );

        // Seed About/Bio data
        $this->call(AboutSeeder::class);
    }
}
