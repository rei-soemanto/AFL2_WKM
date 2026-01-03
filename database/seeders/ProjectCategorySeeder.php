<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;

class ProjectCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Proyek Swasta', 'Proyek Pemerintah (BUMN)', 'Fasilitas Umum', 'Gedung Komersial'];

        foreach ($categories as $cat) {
            ProjectCategory::create(['name' => $cat]);
        }
    }
}