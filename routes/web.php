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
Route::post('productosSimilares',[ProductoController::class,'productosSimilares']);
Route::post('productosOpiniones',[ProductoController::class,'productosOpiniones']);
Route::post('productosOpinionesTodas',[ProductoController::class,'productosOpinionesTodas']);
Route::post('marcaProducto',[ProductoController::class,'marcaProducto']);
Route::post('filtroSearchBar',[ProductoController::class,'filtroSearchBar']);
Route::post('filtroCatPrinc',[ProductoController::class,'filtroCatPrinc']);
//sesiones
Route::get('add-to-cart/{id}',[ProductoController::class,'addToCart']);
Route::get('add-to-cart-producto/{id}/{cantidad}',[ProductoController::class,'addToCartProducto']);
Route::patch('update-cart',[ProductoController::class,'updateCart']);
Route::delete('remove-from-cart',[ProductoController::class,'removeFromCart']);

//compra
Route::get('enviarDinero/{precio_total}/',[ProductoController::class, 'enviarDinero']);

Route::get('comprado',[ProductoController::class, 'compra']);

Route::get('/comprafinalizada',[ProductoController::class, 'mostrarCompra']);



