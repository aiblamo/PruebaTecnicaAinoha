<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        
        //retornamos la vista del dashboard
        return view('dashboard.index');
    }
}
