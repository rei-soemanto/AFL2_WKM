<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Jasa Konstruksi Bangunan',
            'Instalasi ME (Mechanical Electrical)',
            'Konsultasi Arsitektur',
            'Maintenance Alat Berat'
        ];

        foreach ($categories as $cat) {
            ServiceCategory::create(['name' => $cat]);
        }
    }
}