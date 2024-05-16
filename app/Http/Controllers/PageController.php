<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function home(){
        $products=Product::all();
        return view('home', ['products'=>$products]);
    }

    public function product(Product $product){
        //consulta a base de datos
       
        return view('product', ['product'=>$product]);
    }
}
