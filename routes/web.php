<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\FacturaVisitaController;
use App\Http\Controllers\HtmlToPDFController;
use App\Http\Controllers\ItemController;

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

//LOGIN
Route::get('/login', [CitasController::class, 'login']);
Route::post('/login-proc', [CitasController::class, 'loginProc']);
//Citas
Route::get('/citas', [CitasController::class, 'index']);
//Uso de api
Route::get('/showcitas', [CitasController::class, 'showcitas']);

