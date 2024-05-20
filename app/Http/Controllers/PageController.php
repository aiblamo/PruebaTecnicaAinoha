<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importar el modelo Product
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Muestra la página de inicio.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function home()
    {
        // Obtener todos los productos desde la base de datos
        $products = Product::all();

        // Devolver la vista 'home' con los productos
        return view('home', ['products' => $products]);
    }

    /**
     * Muestra la página de un producto específico.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Contracts\View\View
     */
    public function product(Product $product)
    {
        // Devolver la vista 'product' con el producto especificado
        return view('product', ['product' => $product]);
    }
}
