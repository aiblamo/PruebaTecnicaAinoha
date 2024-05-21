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
    public function home(Request $request)
    {
        // Obtener el término de búsqueda desde la solicitud
        $search = $request->input('search');

        // Si hay una búsqueda, filtrar los productos; de lo contrario, obtener todos los productos
        if ($search) {
            $products = Product::where('name', 'LIKE', "%{$search}%")->get();
        } else {
            $products = Product::all();
        }

        // Devolver la vista 'home' con los productos
        return view('home', ['products' => $products, 'search' => $search]);
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
