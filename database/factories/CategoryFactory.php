<?php

namespace Database\Factories;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\ProductPrice;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as FakerFactory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $faker = FakerFactory::create();

        return [
            'name' => $faker->unique()->word,
            'description' => $faker->sentence,
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
