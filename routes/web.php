<?php

use App\Http\Controllers\CitasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\FacturaVisitaController;
use App\Http\Controllers\VisitaController;
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
    return view('home');
});

Route::get('/login', [CitasController::class, 'login']);

//Ruta que nos lleva a funcion que elimina todas las sesiones
Route::post('/logout', [CitasController::class, 'logout']);


Route::post('login-proc', [CitasController::class, 'loginProc']);
Route::get('citas', [CitasController::class, 'Citas']);




//INICIO RUTAS FACTURAS
//FACTURAS TIENDA//

//Ruta para entrar a facturas
Route::get('/FacturasTienda', [FacturaCompraController::class, 'directorioFacturasTienda']);
Route::post('/FacturasTienda', [FacturaCompraController::class, 'directorioFacturasTienda']);
//Ruta para ver cada factura
Route::get('/FacturaTienda/view', [FacturaCompraController::class, 'directorioFacturasTienda']);
Route::post('/FacturaTienda/view', [FacturaCompraController::class, 'vistaFacturaTienda']);
//Ruta para generar Facturas
Route::get('/FacturaTienda/download', [FacturaCompraController::class, 'directorioFacturasTienda']);
Route::post('/FacturaTienda/download', [FacturaCompraController::class, 'createPDFTienda']);

//FACTURAS VISITAS//

//Ruta para entrar a facturas visitas
Route::get('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);

Route::get('/FacturaClinica/view', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturaClinica/view', [FacturaVisitaController::class, 'vistaFacturaClinica']);

Route::get('/FacturaClinica/download', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturaClinica/download', [FacturaVisitaController::class, 'createPDFClinica']);

//FIN FACTURAS

//TEST

Route::get('/hello', [VisitaController::class, 'preRellenarVisitaClinica']);
Route::post('/cerrarVisita', [VisitaController::class, 'RellenoVisita']);