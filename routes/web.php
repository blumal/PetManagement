<?php

use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use App\Http\Controllers\mapas;

=======
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\FacturaVisitaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HtmlToPDFController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CitasController;
>>>>>>> origin/gerard
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
//Mapas
Route::get('mapa_establecimientos', [mapas::class,'mapa_establecimientos']);

<<<<<<< HEAD
Route::get('markersEstablecimientos', [mapas::class,'markersEstablecimientos']);

Route::get('mapa_animales_perdidos', [mapas::class,'mapa_animales_perdidos']);

Route::get('markersAnimalesPerdidos', [mapas::class,'markersAnimalesPerdidos']);

Route::get('animales_perdidos', [mapas::class,'animales_perdidos']);

Route::get('adminMapasEstablecimientos', [mapas::class,'adminMapasEstablecimientos']);

Route::get('filtroMapasEstablecimientos', [mapas::class,'filtroMapasEstablecimientos']);

Route::post('crearMapasEstablecimientos',[mapas::class, 'crearMapasEstablecimientos']);

Route::put('modificarMapasEstablecimientos',[mapas::class, 'modificarMapasEstablecimientos']);

Route::delete('eliminarMapasEstablecimientos',[mapas::class, 'eliminarMapasEstablecimientos']);

Route::post('crearAnimalPerdido',[mapas::class, 'crearAnimalPerdido']);
=======

Route::get('/', function () {
    return view('home');
});

Route::get('/login', [CitasController::class, 'login']);
Route::post('/login-proc', [CitasController::class, 'loginProc']);
//Ruta que nos lleva a funcion que elimina todas las sesiones
Route::post('/logout', [CitasController::class, 'logout']);
//Citas
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

//Api
Route::get('showcitas', [CitasController::class, 'showcitas']);

>>>>>>> origin/gerard
