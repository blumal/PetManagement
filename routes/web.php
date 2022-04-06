<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('secciones');
});
/*Carrito */
Route::post('/carritoadd',[ProductoController::class, 'CartAdd']);

Route::get('/carritoview',[ProductoController::class, 'CartCheckout']);

Route::get('/carritovaciar',[ProductoController::class, 'CartClearOut']);

Route::get('vistaprueba',[ProductoController::class,'mostrarProducto']);

/*Crud */

Route::get('admincrud',[ProductoController::class,'mostrarProductoCrud']);

Route::post('filtro',[ProductoController::class,'show']);

Route::post('crear',[ProductoController::class,'crear']);

Route::delete('eliminar/{id}',[ProductoController::class,'eliminar']);

Route::put('actualizar',[ProductoController::class,'update']);
