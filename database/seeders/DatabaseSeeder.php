<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('dashboard_users')->insert([
            [
                'name' => 'Azab',
                'email' => 'azab@elsadat.com',
                'password' => Hash::make('Err0r@Err0r123'),
                'user_type' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moderator User',
                'email' => 'moderator@elsadat.com',
                'password' => Hash::make('12345678'),
                'user_type' => 'moderator',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Project Manager User',
                'email' => 'pm@elsadat.com',
                'password' => Hash::make('12345678'),
                'user_type' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Media User',
                'email' => 'media@elsadat.com',
                'password' => Hash::make('12345678'),
                'user_type' => 'media',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
