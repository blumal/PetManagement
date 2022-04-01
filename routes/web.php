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

//FACTURAS TIENDA//

//Ruta para entrar a facturas
Route::get('/FacturasTienda', [FacturaCompraController::class, 'directorioFacturasTienda']);
//Ruta para ver cada factura
Route::get('/FacturaTienda/view/{id_factura_tienda}', [FacturaCompraController::class, 'vistaFacturaTienda']);
//Ruta para generar Facturas
Route::get('/FacturaTienda/download/{id_factura_tienda}', [FacturaCompraController::class, 'createPDFTienda']);

//FACTURAS VISITAS//

//Ruta para entrar a facturas visitas
Route::get('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);

Route::post('/FacturaClinica/view', [FacturaVisitaController::class, 'vistaFacturaClinica']);

