<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        // Obtener un ID de producto solo si hay productos en la base de datos
        $productId = Product::exists() ? Product::inRandomOrder()->first()->id : Product::factory()->create()->id;

        return [
            'product_id' => $productId,
            'fecha_pedido' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'unidades_comprar' => $this->faker->numberBetween(1, 100),
            'total' => $this->faker->randomFloat(2, 1, 1000), // Precio total aleatorio entre 1 y 1000
        ];
    }
}
