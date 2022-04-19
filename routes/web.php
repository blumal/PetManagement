<?php

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Models\Producto;
use App\Http\Controllers\mapas;
use App\Http\Controllers\FacturaCompraController;
use App\Http\Controllers\FacturaVisitaController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\HtmlToPDFController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CitasController;
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
//Views


//Mapas
Route::get('mapa_establecimientos', [mapas::class,'mapa_establecimientos']);

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

Route::get('', function () {
    return view('home');
});

Route::get('about', function () {
    return view('about');
});

Route::get('contacto', function () {
    return view('contacto');
});

/* Route::get('tienda', [CitasController::class, 'tienda']); */

Route::get('/login', [CitasController::class, 'login']);
Route::post('/login-proc', [CitasController::class, 'loginProc']);
//Ruta que nos lleva a funcion que elimina todas las sesiones
Route::get('/logout', [CitasController::class, 'logout']);
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
//Route::get('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);

Route::get('/FacturaClinica/view', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturaClinica/view', [FacturaVisitaController::class, 'vistaFacturaClinica']);

Route::get('/FacturaClinica/download', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('FacturaClinica/download', [FacturaVisitaController::class, 'createPDFClinica']);

Route::post('anadir_item_factura_visita', [VisitaController::class, 'anadir_item_factura']);
Route::post('calcular_total', [VisitaController::class, 'calcular_total']);


//FIN FACTURAS
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

//TEST

Route::post('/generarFactura', [VisitaController::class, 'preRellenarVisitaClinica']);
Route::post('/cerrarVisita', [VisitaController::class, 'RellenoVisita']);

//Api
Route::get('showcitas', [CitasController::class, 'showcitas']);
Route::post('insertcita', [CitasController::class, 'insertCita']);
//TIENDA



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
Route::get('add-to-cart-producto/{id}/{cantidad}',[ProductoController::class,'addToCartProducto']);
Route::patch('update-cart',[ProductoController::class,'updateCart']);
Route::delete('remove-from-cart',[ProductoController::class,'removeFromCart']);

/*Crud */

Route::get('admincrud',[ProductoController::class,'mostrarProductoCrud']);

Route::post('filtro',[ProductoController::class,'show']);

Route::post('crear',[ProductoController::class,'crear']);

Route::delete('eliminar/{id}',[ProductoController::class,'eliminar']);

Route::put('actualizar',[ProductoController::class,'update']);
//compra
Route::get('enviarDinero/{precio_total}/',[ProductoController::class, 'enviarDinero']);

Route::get('comprado',[ProductoController::class, 'compra']);

Route::get('/comprafinalizada',[ProductoController::class, 'mostrarCompra']);
