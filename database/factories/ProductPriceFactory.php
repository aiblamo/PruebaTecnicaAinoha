<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductPrice; // Importa el modelo Product
use Illuminate\Database\Eloquent\Factories\Factory;

use Faker\Factory as FakerFactory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductPrices>
 */
class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;

    public function definition(): array
    {
        $faker = FakerFactory::create();
        $startDate = $faker->dateTimeBetween('-1 year', 'now');
        $endDate = $faker->dateTimeBetween($startDate, '+1 year');

        // Obtener un ID de producto solo si hay productos en la base de datos
        $productId = Product::inRandomOrder()->first()->id ?? Product::factory()->create()->id;

        return [
            'product_id' => $productId,
            'price' => $faker->randomFloat(2, 1, 100),
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }
}
