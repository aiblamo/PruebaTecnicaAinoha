<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\AppointmentController;

use Illuminate\Support\Facades\Route;


Route::controller(PageController::class)->group(function(){
    Route::get('/',                 'home')->name('home');
    Route::get('/product',  'product')->name('product');
    
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('users', UserController::class);
Route::resource('products', ProductController::class)->middleware('auth')->except(['show']);
Route::resource('appointments', AppointmentController::class)->middleware('auth')->except(['show']);
Route::get('/appointments/price/{productId}', [AppointmentController::class, 'getProductPrice'])->name('appointments.price');
Route::get('/productos/{id}/pdf', [ProductController::class, 'downloadPdf'])->name('products.pdf');
Route::resource('categories', CategoryController::class)->middleware('auth')->except(['show']);

Route::get('/', [PageController::class, 'home'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/export/products', [ExportController::class, 'export'])->name('export.products');



require __DIR__.'/auth.php';
