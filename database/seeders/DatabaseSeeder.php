<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use App\Models\ProductPrice;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un usuario
        User::factory()->create();

        // Crear productos y precios para cada producto
        $products = Product::factory(10)->create();
        foreach ($products as $product) {
            ProductPrice::factory()->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
