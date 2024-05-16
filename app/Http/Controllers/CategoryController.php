<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){

        return view('categories.index',[
            'categories'=>Category::all()
        ]);
    }

    public function destroy(Category $category){
        $category->delete();
        return back();
    }

    public function create(Category $category){
        $categories = Category::all(); // Obtener todas las categorías existentes
        return view('categories.create', ['category'=>$category], compact('categories'));
        
       
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'parent_id' => 'nullable|exists:categories,id', // Hace que parent_id sea opcional y valida si existe en la tabla categories
        ]);
    
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();
    
        return redirect()->route('categories.index')->with('success', 'Categoría creada exitosamente.');
    }
    

    public function edit(Category $category){
        $categories = Category::all(); // Obtener todas las categorías existentes
       
        return view('categories.edit', ['category'=>$category],compact('categories'));
    }

    public function update(Request $request, Category $category){
        
        $request->validate([
            'name' => 'required',
            'description'=>'required',
            'parent_id' => 'nullable|exists:categories,id',
            
        ]);
    
    
        // Actualiza los otros datos del producto con los valores recibidos en la solicitud
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parent_id;
        $category->save();
    
       
       
    
        // Redirige de vuelta a la vista de índice de categorias
        return redirect()->route('categories.index');
    }
    

}
