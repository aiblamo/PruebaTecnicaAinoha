<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryProduct>
 */
class CategoryProductFactory extends Factory
{
    protected $model = CategoryProduct::class;

    public function definition(): array
    {
        // Obtener IDs de categorías y productos existentes
        $categoryIds = Category::pluck('id')->toArray();
        $productIds = Product::pluck('id')->toArray();

        // Seleccionar aleatoriamente una categoría y un producto existentes
        $categoryId = $this->faker->randomElement($categoryIds);
        $productId = $this->faker->randomElement($productIds);

        return [
            'category_id' => $categoryId,
            'product_id' => $productId,
        ];
    }
}

