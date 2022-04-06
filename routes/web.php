<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;



Route::get('tienda',[ProductoController::class,'tienda']);
Route::get('carrito',[ProductoController::class,'carrito']);
Route::post('marcas',[ProductoController::class,'marcas']);
Route::post('tiposPrincipales',[ProductoController::class,'tiposPrincipales']);
Route::post('productos',[ProductoController::class,'productos']);
Route::get('producto/{id}',[ProductoController::class,'producto']);
Route::post('marcaProducto',[ProductoController::class,'marcaProducto']);
Route::post('filtroSearchBar',[ProductoController::class,'filtroSearchBar']);
Route::post('filtroCatPrinc',[ProductoController::class,'filtroCatPrinc']);
//sesiones
Route::get('add-to-cart/{id}',[ProductoController::class,'addToCart']);
Route::post('add-to-cart-producto',[ProductoController::class,'addToCartProducto']);
//Route::patch('update-cart',[ProductoController::class,'update-cart']);
//Route::delete('remove-from-cart',[ProductoController::class,'remove-from-cart']);


