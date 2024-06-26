<?php
namespace Database\Factories;

use App\Models\ProductPrice;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductPriceFactory extends Factory
{
    protected $model = ProductPrice::class;

    public function definition(): array
    {
        // Obtener un ID de producto solo si hay productos en la base de datos
        $productId = Product::exists() ? Product::inRandomOrder()->first()->id : Product::factory()->create()->id;

        return [
            'product_id' => $productId,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
