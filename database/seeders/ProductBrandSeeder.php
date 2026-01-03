<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductBrand;

class ProductBrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = ['Kencana Mukti Steel', 'Schneider Electric', 'Holcim', 'Semen Gresik', 'Bosch'];

        foreach ($brands as $brand) {
            ProductBrand::create(['name' => $brand]);
        }
    }
}