<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@dampit.com',
            'role' => 'Administrator',
            'password' => Hash::make('12345678'),
        ]);

        User::create([
            'name' => 'Kepala Desa',
            'email' => 'kepdes@dampit.com',
            'role' => 'Kepala Desa',
            'password' => Hash::make('12345678'),
        ]);
    }
}
