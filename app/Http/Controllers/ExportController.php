<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Exports\ProductsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Export products to Excel.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function export()
    {
        $userId = auth()->id(); // Obtener el ID del usuario autenticado
        return Excel::download(new ProductsExport($userId), 'products.xlsx');
    }
}
