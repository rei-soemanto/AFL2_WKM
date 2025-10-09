<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            ProductBrandSeeder::class,
            ProductCategorySeeder::class,
            ProjectSeeder::class,
            ProjectCategorySeeder::class,
            ProjectImageSeeder::class,
            ServiceSeeder::class,
            ServiceCategorySeeder::class
        ]);

        Service::factory()->count(10)->create();

        Product::factory()->count(100)->create();

        Project::factory()->count(10)->create();
    }
}
