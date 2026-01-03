<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $category = ServiceCategory::first();
        $admin = User::where('role_id', 1)->first();

        Service::create([
            'name' => 'Instalasi ME (Mechanical Electrical)',
            'category_id' => $category->id,
            'description' => 'Layanan instalasi listrik dan mekanik gedung profesional.',
            'last_update_by' => $admin->id,
        ]);
    }
}