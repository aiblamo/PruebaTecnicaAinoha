<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductPrice;

use Dompdf\Dompdf;
use PDF;


use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){
        return view('products.index', [
            'products'=>Product::all()
            
        ]);
    }

    public function destroy(Product $product){
        $product->delete();
        return back();
    }

    public function create(Product $product){
        
        $categories = Category::all();
        return view('products.create', compact('product','categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);
        
        // Verifica si se ha proporcionado una imagen
        if ($request->hasFile('photo')) {
            // Guarda la nueva foto en el disco 'public'
            $photoPath = $request->file('photo')->store('photos', 'public');
        
            // Crea un nuevo producto con los datos recibidos
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'photo' => $photoPath, // Guarda la ruta de la foto en la base de datos
            ]);
    
            // Guarda los detalles adicionales
            $product->prices()->create([
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);

             // Adjunta las categorías seleccionadas al producto
            $product->categories()->attach($request->category_id);
        }
    
        return redirect()->route('products.index');
    }
    
    

    public function edit(Product $product){
        // Carga la relación 'prices' para el producto, ordena por la fecha de inicio en orden descendente y toma el primero
        $product->load(['prices' => function ($query) {
            $query->latest()->first();
        }, 'categories']); // Carga la relación 'categories' para el producto
    
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }
    

    public function update(Request $request, Product $product){
        
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // make photo field nullable to allow updates without changing the photo
            'price'=>'required|numeric',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date',
        ]);
    
        // Si se proporciona una nueva foto
        if ($request->hasFile('photo')) {
            // Guarda la nueva foto y obtén la ruta
            $photoPath = $request->file('photo')->store('photos', 'public');
    
            // Actualiza la foto del producto con la nueva ruta
            $product->photo = $photoPath;
        }
    
        // Actualiza los otros datos del producto con los valores recibidos en la solicitud
        $product->name = $request->name;
        $product->description = $request->description;
        $product->save();
    
        // Si el producto tiene un precio asociado
        if ($product->price) {
            // Actualiza los datos de precio
            $product->price->update([
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        } else {
            // Si no existe un precio asociado, crea uno nuevo
            $product->prices()->create([
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);
        }
    
        // Redirige de vuelta a la vista de índice de productos
        return redirect()->route('products.index');
    }

    public function downloadPdf($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            abort(404);
        }
    
        // Crear una nueva instancia de Dompdf
        $dompdf = new Dompdf();
    
        // Cargar la vista 'products.pdf' con los datos del producto
        $html = view('products.pdf', compact('product'));
    
        // Cargar el contenido HTML en Dompdf
        $dompdf->loadHtml($html);
    
        // Renderizar el PDF
        $dompdf->render();
    
        // Descargar el PDF con un nombre de archivo específico
        return $dompdf->stream('producto_'.$product->id.'.pdf');
    }
    
    
    
}