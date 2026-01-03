<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Material Konstruksi',
            'Sistem Kelistrikan',
            'Interior & Furniture',
            'Alat Pelindung Diri (APD)',
            'Suku Cadang Mesin'
        ];

        foreach ($categories as $category) {
            ProductCategory::create(['name' => $category]);
        }
    }
}