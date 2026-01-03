<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role_id', 1)->first();
        $category = ProjectCategory::first();

        $project = Project::create([
            'name' => 'Pembangunan Kantor Pusat Kencana',
            'description' => 'Proyek gedung bertingkat dengan konsep industrial.',
            'last_update_by' => $admin->id,
        ]);

        DB::table('project_category_assignments')->insert([
            'project_id' => $project->id,
            'category_id' => $category->id,
        ]);

        $images = [
            ['path' => 'uploads/image/projects/landscape.png', 'order' => 1],
            ['path' => 'uploads/image/projects/no-bg.png', 'order' => 2],
            ['path' => 'uploads/image/projects/portrait.jpg', 'order' => 3],
        ];

        foreach ($images as $img) {
            DB::table('project_images')->insert([
                'project_id' => $project->id,
                'image_path' => $img['path'],
                'upload_order' => $img['order']
            ]);
        }
    }
}