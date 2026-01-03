<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $brand = ProductBrand::first();
        $category = ProductCategory::first();
        $admin = User::where('role_id', 1)->first();

        $products = [
            [
                'name' => 'Semen Portland Wraksa',
                'description' => 'Semen kualitas premium untuk pondasi.',
                'image' => 'uploads/image/products/landscape.png',
                'pdf' => 'uploads/pdf/grrrkecktQQecBVc9hk3oB5OF09zm63Z6u1c2KIS.pdf'
            ],
            [
                'name' => 'Baja Ringan Kencana',
                'description' => 'Baja ringan anti karat dan tahan lama.',
                'image' => 'uploads/image/products/no-bg.png',
                'pdf' => 'uploads/pdf/grrrkecktQQecBVc9hk3oB5OF09zm63Z6u1c2KIS.pdf'
            ],
            [
                'name' => 'Pipa PVC Heavy Duty',
                'description' => 'Pipa tekanan tinggi untuk industri.',
                'image' => 'uploads/image/products/portrait.jpg',
                'pdf' => 'uploads/pdf/grrrkecktQQecBVc9hk3oB5OF09zm63Z6u1c2KIS.pdf'
            ],
        ];

        foreach ($products as $p) {
            Product::create([
                'name' => $p['name'],
                'brand_id' => $brand->id,
                'category_id' => $category->id,
                'description' => $p['description'],
                'image' => $p['image'],
                'pdf_path' => $p['pdf'],
                'is_hidden' => false,
                'last_update_by' => $admin->id,
            ]);
        }
    }
}