<?php

use App\Http\Controllers\CitasController;
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


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [CitasController::class, 'login']);
Route::post('login-proc', [CitasController::class, 'loginProc']);
Route::get('citas', [CitasController::class, 'loginProc']);
//FACTURAS TIENDA//

//Ruta para entrar a facturas
Route::get('/FacturasTienda', [FacturaCompraController::class, 'directorioFacturasTienda']);
//Ruta para ver cada factura
Route::post('/FacturaTienda/view', [FacturaCompraController::class, 'vistaFacturaTienda']);
//Ruta para generar Facturas
Route::post('/FacturaTienda/download', [FacturaCompraController::class, 'createPDFTienda']);

//FACTURAS VISITAS//

//Ruta para entrar a facturas visitas
Route::post('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);

Route::post('/FacturaClinica/view', [FacturaVisitaController::class, 'vistaFacturaClinica']);

Route::post('/FacturaClinica/download', [FacturaVisitaController::class, 'createPDFClinica']);
