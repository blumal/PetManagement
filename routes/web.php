<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Http\Controllers\DB;



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
Route::patch('update-cart',[ProductoController::class,'updateCart']);
Route::delete('remove-from-cart',[ProductoController::class,'removeFromCart']);
//compra
Route::get('enviarDinero/{precio_total}/',[ProductoController::class, 'enviarDinero']);

Route::get('comprado',[ProductoController::class, 'compra']);

/*Carrito 
Route::post('/carritoadd',[ProductoController::class, 'CartAdd']);

Route::get('/carritoview',[ProductoController::class, 'CartCheckout']);

Route::get('/carritovaciar',[ProductoController::class, 'CartClearOut']);

Route::get('vistaprueba',[ProductoController::class,'mostrarProducto']); */

/*Crud */

Route::get('admincrud',[ProductoController::class,'mostrarProductoCrud']);

Route::post('filtro',[ProductoController::class,'show']);

Route::post('crear',[ProductoController::class,'crear']);

Route::delete('eliminar/{id}',[ProductoController::class,'eliminar']);

Route::put('actualizar',[ProductoController::class,'update']);
