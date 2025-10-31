<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        User::create([
            'name' => 'Rei Soemanto',
            'email' => 'reresoemanto@gmail.com',
            'password' => '@Cc2061355',
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);
    }
}