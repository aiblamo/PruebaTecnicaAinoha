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
     */
    public function index()
    {
        $categories=Category::all();
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        
         // Obtener el usuario autenticado
         $user = $request->user();
        
            // Crea un nuevo producto con los datos recibidos
        $category = new Category();
        $category ->name = $request->name;
        $category ->description = $request->description;
        $category->parent_id=$request->parent_id;
    
        $category ->save();

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => new CategoryResource($category),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category=Category::all()->find($id);
        return new CategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {

         // Verificar si el usuario autenticado es el propietario del producto
        if (Auth::id() !== $category->user_id) {
            return response()->json(['error' => 'No tienes permiso para editar esta categoria.'], 403);
        }

        $validatedData=$request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string',
            'parent_id' => 'nullable|exists:categories,id'
        ]);

        

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'parent_id'=>$request->parent_id,

        ]);
        return response()->json(['message' => 'Categoria actualizada con éxito.'], 200);
    

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
    
        if (!$category) {
            return response()->json(['error' => 'Categoria no encontrado.'], 404);
        }
    
        // Verificar si el usuario autenticado es el autor del producto
        if ($request->user()->id !== $category->user_id) {
            return response()->json(['error' => 'No tienes permiso para eliminar esta categoria.'], 403);
        }
    
        $category->delete();
    
        return response()->json(['message' => 'Categoria eliminada correctamente.'], 200);
    }
}
