<?php

namespace Database\Seeders;

use App\Models\ProjectImage;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
