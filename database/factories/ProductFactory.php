<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'description' => $this->faker->sentence,
            'photo' => $this->faker->imageUrl(),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
