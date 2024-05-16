<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;


use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'name' => $faker->unique()->word,
            'description' => $faker->sentence,
            'photo' => $faker->imageUrl(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Product $product) {
            $category = Category::factory()->create();
            $product->categories()->attach($category);
        });
    }
}