<?php

namespace App\Http\Controllers;

use App\Models\FacturaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vistaFactura(){
        $id_factura=1;
        $id_clinica=1;
        try{
            DB::beginTransaction();
                $clinica = DB::table('tbl_clinic')->where('id_clinic','=',$id_clinica)->get();
                $factura = DB::table('tbl_shop_invoice')->where('id_shop_invoice','=',$id_factura)->get();
                //return $factura;
            DB::commit();
            return view('facturas/factura_compra', compact('factura','clinica'));
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FacturaCompra  $facturaCompra
     * @return \Illuminate\Http\Response
     */
    public function show(FacturaCompra $facturaCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacturaCompra  $facturaCompra
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturaCompra $facturaCompra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacturaCompra  $facturaCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturaCompra $facturaCompra)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacturaCompra  $facturaCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturaCompra $facturaCompra)
    {
        //
    }
}
