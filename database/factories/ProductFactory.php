<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => fn () => ProductBrand::inRandomOrder()->first()->id,
            'category_id' => fn () => ProductCategory::inRandomOrder()->first()->id,
            'name' => $this->faker->catchPhrase(),
            'description' => $this->faker->paragraph(),
            'image' => $this->faker->imageUrl(640, 480, 'technology', true),
            'pdf_path' => 'uploads/pdfs/sample-document.pdf',
        ];
    }
}
