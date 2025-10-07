<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(3),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            // Create between 2 and 5 images for this project
            ProjectImage::factory()
                ->count($this->faker->numberBetween(2, 5))
                ->for($project) // Associate them with the project we just created
                ->create();

            // Get some random category IDs to attach
            $categories = ProjectCategory::inRandomOrder()->limit($this->faker->numberBetween(1, 3))->pluck('id');
            $project->categories()->attach($categories);
        });
    }
}
