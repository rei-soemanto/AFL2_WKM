<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
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

        Service::factory()->count(15)->create();

        Product::factory()->count(10)->create();

        Project::factory()->count(8)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
