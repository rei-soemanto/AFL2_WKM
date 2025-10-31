<?php

namespace Database\Seeders;

use app\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Rei Soemanto',
                'email' => 'reresoemanto@gmail.com',
                'password' => '@Cc2061355',
                'role' => 'admin'
            ]
        ]);
    }
}
