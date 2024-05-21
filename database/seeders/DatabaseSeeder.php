<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\CategoryProduct;
use App\Models\Appointment;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Crear 10 usuarios
        $users = User::factory()->count(10)->create();

        // Crear 5 categorías y asignar un usuario aleatorio a cada una
        Category::factory()->count(5)->create()->each(function ($category) use ($users) {
            $category->user_id = $users->random()->id;
            $category->save();
        });

        // Crear 10 productos, cada uno con al menos un precio y asociado a una categoría
        Product::factory()->count(10)->create()->each(function ($product) use ($users) {
            $product->user_id = $users->random()->id;
            $product->save();
        });

        // Crear precios adicionales para productos existentes
        Product::all()->each(function ($product) {
            ProductPrice::factory()->count(rand(1, 3))->create(['product_id' => $product->id]);
        });

        // Vincular productos y categorías
        Product::all()->each(function ($product) {
            $categoryIds = Category::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray();
            $product->categories()->sync($categoryIds);
        });

        // Crear 5 citas
        Appointment::factory()->count(5)->create();
    }

    public function down()
    {
        // Eliminar todos los registros creados durante la ejecución del seeder
        User::truncate();
        Category::truncate();
        Product::truncate();
        ProductPrice::truncate();
        CategoryProduct::truncate();
        Appointment::truncate();
    }
}
