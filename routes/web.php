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
use App\Http\Controllers\EstadisticaController;
use App\Http\Controllers\DB;
use App\Http\Controllers\JuegosController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\UsuarioController;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

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

Route::get('filtromarkersEstablecimientos', [mapas::class,'filtromarkersEstablecimientos']);

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

Route::get('login/contraseña', function () {
    return view('login/contraseña');
});

Route::get('entretenimiento', function () {
    return view('entretenimiento');
});

/* Route::get('tienda', [CitasController::class, 'tienda']); */

// LOGIN LOGOUT Y DEMÁS DE USUARIO
Route::get('/login', [UsuarioController::class, 'login']);
Route::post('/login-proc', [UsuarioController::class, 'loginProc']);

Route::get('registro', function () {return view('login/registro');});
Route::post('/regis-proc', [UsuarioController::class, 'regisProc']);

//Ruta que nos lleva a funcion que elimina todas las sesiones
Route::get('/logout', [UsuarioController::class, 'logout']);

Route::get('/perfil', [UsuarioController::class, 'modificarPerfil']);

//Actualizar Perfil usuario
Route::get('modificarPerfil', [UsuarioController::class, 'modificarPerfil']);
Route::post('modificarPerfilPost',[UsuarioController::class, 'modificarPerfilPost']);

//FINAL RUTAS USUARIO


//geoguesser
Route::get('/geoguesser', [mapas::class, 'geoguesser']);
//geoguesser
Route::get('geoguesser-game', [mapas::class, 'geoguessergame']);
//AJAX Geoguesser
Route::get('geoguesser_ajax', [mapas::class,'geoguesser_ajax']);
//Citas
Route::get('citas', [CitasController::class, 'Citas']);
//Mail a cliente
Route::get('mailtocustomer', [Mailtocustomers::class, '']);
//Cpanel
Route::get('/cpanel', [CitasController::class, 'cpanel']);
//Rutas cpanel
//Curd usrs
Route::get('/cpanelUsrs', [CitasController::class, 'cpanelUsrs']);
//Curd tienda
Route::get('/cpanelTienda', [ProductoController::class, 'mostrarProductoCrud']);
//Curd animales
Route::get('/cpanelAnimales', [CitasController::class, 'cpanelAnimales']);
//Curd animales perdidos
Route::get('/cpanelAnimalesPerdidos', [CitasController::class, 'cpanelAnimalesPerdidos']);
//Curd mapa
Route::get('/cpanelMapa', [CitasController::class, 'cpanelMapa']);

Route::get('/an_perd', [CitasController::class, 'an_perd']);

//Ruleta premios
Route::get('/ruleta',[FacturaVisitaController::class, 'ruleta']);

Route::get('/ruleta_promo',[FacturaVisitaController::class, 'ruleta_promo']);

Route::get('/comprobar_compra',[FacturaVisitaController::class, 'comprobar_compra']);

Route::get('/comprobar_promo',[FacturaVisitaController::class, 'comprobar_promo']);

Route::get('/premio',[FacturaVisitaController::class, 'premio']);

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
Route::get('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturasClinica', [FacturaVisitaController::class, 'directorioFacturasClinica']);

Route::post('/directorioGenerarFactura', function () {return view('facturas/directorioGenerarFacturasClinica');});

Route::post('/leer_visitas', [VisitaController::class, 'VisitasAjax']);

//CERRAR FACTURAS
Route::post('/generarFactura', [VisitaController::class, 'preRellenarVisitaClinica']);
Route::post('/asociarPacienteVisita', [VisitaController::class, 'asociarPacienteVisita']);

Route::post('/cerrarVisita', [VisitaController::class, 'RellenoVisita']);
Route::post('/cerrarAsociacion', [VisitaController::class, 'cerrarAsociacion']);

Route::get('/FacturaClinica/view', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('/FacturaClinica/view', [FacturaVisitaController::class, 'vistaFacturaClinica']);

Route::get('/FacturaClinica/download', [FacturaVisitaController::class, 'directorioFacturasClinica']);
Route::post('FacturaClinica/download', [FacturaVisitaController::class, 'createPDFClinica']);

Route::post('anadir_item_factura_visita', [VisitaController::class, 'anadir_item_factura']);
Route::post('calcular_total', [VisitaController::class, 'calcular_total']);


//FIN FACTURAS

//INICIO ESTADISTICAS
Route::get('/stats', [EstadisticaController::class, 'test']);
Route::post('/estadisticas/recogerStats', [EstadisticaController::class, 'leerStats']);
Route::post('/estadisticas/visitas_por_horas', [EstadisticaController::class, 'visitas_por_horas']);
Route::post('/estadisticas/animales_por_especie', [EstadisticaController::class, 'animales_por_especie']);
Route::post('/estadisticas/visitas_por_meses', [EstadisticaController::class, 'visitas_por_meses']);
Route::post('/estadisticas/tipos_sociedades', [EstadisticaController::class, 'tipos_sociedades']);
//FIN ESTADISTICAS

//INICIO JUEGOS
Route::get('juegos/', function () {
    return view('juegos/directorio');
});
Route::get('juegos/ranita', function () {
    return view('juegos/ranita');
});
Route::post('juegos/ranita/max_scores', [JuegosController::class, 'max_scores']);
Route::post('juegos/ranita/new_score', [JuegosController::class, 'new_score']);


//FIN JUEGOS

//INICIO CRUD PACIENTES
Route::get('/registrarPaciente',[PacienteController::class, 'registrarPaciente']);
Route::post('/cerrarPaciente',[PacienteController::class, 'cerrarPaciente']);
Route::get('/adminPacientes',[PacienteController::class, 'adminPacientes']);
Route::post('/eliminarPaciente',[PacienteController::class, 'eliminarPaciente']);
Route::post('/activarPaciente',[PacienteController::class, 'activarPaciente']);
Route::post('/leerPacientes',[PacienteController::class, 'leerPacientes']);
Route::post('/editarPaciente',[PacienteController::class, 'editarPaciente']);
Route::post('/cerrarPacienteEditar',[PacienteController::class, 'cerrarPacienteEditar']);

// FIN CRUD PACIENTES


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

Route::post('regenerarPassword',[UsuarioController::class, 'regenerarPassword']);

//Api Citas
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
