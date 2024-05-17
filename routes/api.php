<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController as ProductV1;
use App\Http\Controllers\Api\V1\CategoryController as CategoryV1;
use App\Http\Controllers\Api\V1\AppointmentController as  AppointmentV1;
use App\Http\Controllers\Api\LoginController;

Route::apiResource('V1/products', ProductV1::class)
        
        ->middleware('auth:sanctum');

Route::apiResource('V1/categories', CategoryV1::class)
       
        ->middleware('auth:sanctum');

        
Route::apiResource('V1/appointments', AppointmentV1::class)
        ->only(['index','show', 'destroy'])
        ->middleware('auth:sanctum');


        Route::post('login', [
                LoginController::class,
                'login'
            ]);