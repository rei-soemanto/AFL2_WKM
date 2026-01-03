<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin'],
            ['id' => 2, 'name' => 'Manager'],
            ['id' => 3, 'name' => 'Employee'],
            ['id' => 4, 'name' => 'User'],
        ];

        foreach ($roles as $role) {
            DB::table('user_roles')->updateOrInsert(['id' => $role['id']], ['name' => $role['name']]);
        }

        $users = [
            // 1 Admin
            [
                'name'     => 'Admin Wraksa',
                'email'    => 'admin@wraksakencana.com',
                'password' => Hash::make('password123'),
                'role_id'  => 1,
            ],
            // 1 Manager
            [
                'name'     => 'Manager Wraksa',
                'email'    => 'manager@wraksakencana.com',
                'password' => Hash::make('password123'),
                'role_id'  => 2,
            ],
            // 2 Employee
            [
                'name'     => 'Employee Satu',
                'email'    => 'employee1@wraksakencana.com',
                'password' => Hash::make('password123'),
                'role_id'  => 3,
            ],
            [
                'name'     => 'Employee Dua',
                'email'    => 'employee2@wraksakencana.com',
                'password' => Hash::make('password123'),
                'role_id'  => 3,
            ],
            // 2 User
            [
                'name'     => 'User Reguler Satu',
                'email'    => 'user1@gmail.com',
                'password' => Hash::make('password123'),
                'role_id'  => 4,
            ],
            [
                'name'     => 'User Reguler Dua',
                'email'    => 'user2@gmail.com',
                'password' => Hash::make('password123'),
                'role_id'  => 4,
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrInsert(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}