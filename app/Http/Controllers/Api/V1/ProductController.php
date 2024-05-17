<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\V1\ProductResource;
use App\Http\Resources\V1\ProductPriceResource;
use App\Http\Resources\V1\CategoryResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('prices', 'categories')->get();
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valida los datos de la solicitud
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
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
        }
    
         // Obtener el usuario autenticado
         $user = $request->user();
        
         // Crea un nuevo producto con los datos recibidos
      $product = new Product();
      $product->name = $request->name;
      $product->description = $request->description;
      $product->photo = $photoPath;
      $product->user_id = $user->id; // Asigna el ID del usuario autenticado
      $product->save();
          
         
         

        // Guarda los detalles adicionales del producto
        $product->prices()->create([
            'price' => $validatedData['price'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);
    
        // Adjunta las categorías seleccionadas al producto
        $product->categories()->attach($validatedData['category_id']);
    
        // Devuelve una respuesta JSON con el nuevo producto creado
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => new ProductResource($product),
        ]);
    }
    
  
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::with('prices', 'categories')->find($id);
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    // Verificar si el usuario autenticado es el propietario del producto
    if (Auth::id() !== $product->user_id) {
        return response()->json(['error' => 'No tienes permiso para editar este producto.'], 403);
    }

    // Validar los datos de entrada
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'price' => 'required|numeric',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
        'category_id' => 'required|exists:categories,id',
    ]);

    // Actualizar el producto
    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        // Actualizar la foto solo si se proporciona una nueva
        'photo' => $request->hasFile('photo') ? $request->file('photo')->store('photos', 'public') : $product->photo,
    ]);

    // Actualizar el precio del producto
    $product->prices()->update([
        'price' => $request->price,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
    ]);

    // Actualizar las categorías del producto
    $product->categories()->sync([$request->category_id]);

    // Retornar una respuesta de éxito
    return response()->json(['message' => 'Producto actualizado con éxito.'], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }
    
        // Verificar si el usuario autenticado es el autor del producto
        if ($request->user()->id !== $product->user_id) {
            return response()->json(['error' => 'No tienes permiso para eliminar este producto.'], 403);
        }
    
        $product->delete();
    
        return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
    }
}
