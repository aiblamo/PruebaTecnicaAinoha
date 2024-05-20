<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Resources\V1\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todas las categorías
        $categories = Category::all();
        
        // Devolver una colección de recursos de categorías
        return CategoryResource::collection($categories);
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
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Crear una nueva categoría con los datos recibidos
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        // Devolver una respuesta JSON con el resultado
        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category),
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
        // Encontrar la categoría por su ID
        $category = Category::findOrFail($id);

        // Devolver un recurso de categoría
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // Validar los datos de la solicitud
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        // Actualizar la categoría con los nuevos datos
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Categoria actualizada con éxito.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // Encontrar la categoría por su ID
        $category = Category::find($id);

        // Verificar si la categoría existe
        if (!$category) {
            return response()->json(['error' => 'Categoria no encontrado.'], 404);
        }

        // Verificar si el usuario autenticado es el autor de la categoría
        if ($request->user()->id !== $category->user_id) {
            return response()->json(['error' => 'No tienes permiso para eliminar esta categoria.'], 403);
        }

        // Eliminar la categoría
        $category->delete();

        // Devolver una respuesta JSON
        return response()->json(['message' => 'Categoria eliminada correctamente.'], 200);
    }
}
