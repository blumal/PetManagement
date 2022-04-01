<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacturaCompraController;
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


//Ruta para entrar a facturas
//Route::get('/Facturas', [FacturaCompraController::class, 'directorioFacturas']);
Route::get('/Factura/2', [FacturaCompraController::class, 'vistaFactura']);

//Route::get('generate-html-to-pdf', 'HtmlToPDFController@index')->name('generate-html-to-pdf');

//Route::get('generate-html-to-pdf', [HtmlToPDFController::class, 'index']);

Route::get('/Factura/pdf', [FacturaCompraController::class, 'createPDF']);


