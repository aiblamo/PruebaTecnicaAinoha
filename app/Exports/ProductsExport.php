<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Auth;

class ProductsExport implements FromView, WithMapping
{
    protected $userId;

    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    // Método que devuelve la vista para la exportación
    public function view(): View
    {
        // Obtener los productos asociados al usuario autenticado
        $products = Product::where('user_id', $this->userId)->get();

        // Devolver la vista 'exports.products' con los datos de los productos
        return view('exports.products', [
            'products' => $products
        ]);
    }

    // Método que mapea los datos del producto para la exportación
    public function map($product): array
    {
        // Mapea los atributos del producto a un array que será exportado
        return [
            $product->id, // ID del producto
            $product->name, // Nombre del producto
            $product->categories->pluck('id')->implode(', '), // ID de la(s) categoría(s) del producto
            $product->created_at->format('Y-m-d H:i:s'), // Fecha de creación del producto
            $product->updated_at->format('Y-m-d H:i:s'), // Fecha de última modificación del producto
        ];
    }
}
