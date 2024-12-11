<?php

use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas protegidas para Productos
Route::get('products', [ProductController::class, 'index']);
// Filtrar los Productos por Color
Route::get('products/{color}/color', [ProductController::class, 'filterProductsByColor']);
// Filtrar los Productos por Tamaño
Route::get('products/{size}/size', [ProductController::class, 'filterProductsBySize']);

Route::get('products/{searchTerm}/find', [ProductController::class, 'searchProductsByTerm']);

Route::get('products/{product}/show', [ProductController::class, 'show']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});