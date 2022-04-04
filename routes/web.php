<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\mapas;

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

Route::get('mapa_establecimientos', [mapas::class,'mapa_establecimientos']);

Route::get('markersEstablecimientos', [mapas::class,'markersEstablecimientos']);

Route::get('mapa_animales_perdidos', [mapas::class,'mapa_animales_perdidos']);

Route::get('markersAnimalesPerdidos', [mapas::class,'markersAnimalesPerdidos']);

Route::get('adminMapasEstablecimientos', [mapas::class,'adminMapasEstablecimientos']);

Route::get('filtroMapasEstablecimientos', [mapas::class,'filtroMapasEstablecimientos']);

Route::post('crearMapasEstablecimientos',[mapas::class, 'crearMapasEstablecimientos']);

Route::put('modificarMapasEstablecimientos',[mapas::class, 'modificarMapasEstablecimientos']);

Route::delete('eliminarMapasEstablecimientos',[mapas::class, 'eliminarMapasEstablecimientos']);