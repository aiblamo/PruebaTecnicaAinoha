<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // Obtener todas las categorías del usuario autenticado
        $categories = Category::where('user_id', $userId)->get();

        // Devolver la vista de índice de categorías con las categorías del usuario
        return view('categories.index', compact('categories'));
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
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id', // Hace que parent_id sea opcional y valida si existe en la tabla categories
        ]);

        // Obtener el usuario autenticado
        $user = $request->user();

        // Crear una nueva categoría con los datos recibidos
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->user_id = $user->id;
        $category->save();

        // Redirigir a la vista de índice de categorías con un mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        // Obtener todas las categorías existentes
        $categories = Category::all();

        // Devolver la vista de edición de categoría con la categoría específica y las categorías existentes
        return view('categories.edit', compact('category', 'categories'));
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
        // Verificar si el usuario autenticado es el propietario de la categoría
        if ($request->user()->id !== $category->user_id) {
            // Si el usuario no es el autor, devolver un mensaje de error o redirigir
            return redirect()->back()->with('error', 'No tienes permiso para editar esta categoría.');
        }
        
        // Validar los datos de la solicitud
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Actualizar los datos de la categoría con los valores recibidos en la solicitud
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();

        // Redirigir de vuelta a la vista de índice de categorías
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Eliminar la categoría
        $category->delete();

        // Redirigir de vuelta
        return back();
    }
}
