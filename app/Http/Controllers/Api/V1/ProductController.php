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
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los productos con sus precios y categorías
        $products = Product::with('prices', 'categories')->get();
        
        // Devolver una colección de recursos de productos
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Guardar la foto en el disco 'public'
        $photoPath = $request->file('photo')->store('photos', 'public');

        // Crear un nuevo producto con los datos recibidos
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->photo = $photoPath;
        $product->user_id = $request->user()->id; // Asignar el ID del usuario autenticado
        $product->save();

        // Guardar los detalles adicionales del producto
        $product->prices()->create([
            'price' => $validatedData['price'],
            'start_date' => $validatedData['start_date'],
            'end_date' => $validatedData['end_date'],
        ]);

        // Adjuntar las categorías seleccionadas al producto
        $product->categories()->attach($validatedData['category_id']);

        // Devolver una respuesta JSON con el nuevo producto creado
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => new ProductResource($product),
        ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener el producto con sus precios y categorías por su ID
        $product = Product::with('prices', 'categories')->find($id);

        // Devolver un recurso de producto
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Verificar si el usuario autenticado es el propietario del producto
        if (Auth::id() !== $product->user_id) {
            return response()->json(['error' => 'No tienes permiso para editar este producto.'], 403);
        }

        // Validar los datos de la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Encontrar el producto por su ID
        $product = Product::find($id);

        // Verificar si el producto existe
        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }

        // Verificar si el usuario autenticado es el autor del producto
        if (Auth::id() !== $product->user_id) {
            return response()->json(['error' => 'No tienes permiso para eliminar este producto.'], 403);
        }

        // Eliminar el producto
        $product->delete();

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Producto eliminado correctamente.'], 200);
    }
}
