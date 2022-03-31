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
                $clinica = DB::table('tbl_clinic')
                ->join('tbl_address', 'tbl_clinic.id_address_clinic', '=', 'tbl_address.id_address')
                ->join('tbl_phone', 'tbl_clinic.id_phone_clinic', '=', 'tbl_phone.id_phone')
                ->where('id_clinic','=',$id_clinica)
                ->get();

                $factura = DB::table('tbl_shop_invoice')
                ->where('id_shop_invoice','=',$id_factura)
                ->get();

                $id_user=$factura[0]->id_user_shop_invoice;

                $cliente = DB::table('tbl_usuario')
                ->join('tbl_address', 'tbl_usuario.id_address', '=', 'tbl_address.id_address')
                ->join('tbl_phone', 'tbl_usuario.id_phone', '=', 'tbl_phone.id_phone')
                ->where('id_user','=',$id_user)
                ->get();

                $items_compra=DB::table('tbl_shop_invoice_detail')
                ->where('id_invoice_shop_invoice_detail','=',$id_factura)
                ->join('tbl_product', 'tbl_shop_invoice_detail.id_product_shop_invoice', '=', 'tbl_product.id_product')
                ->get();
                //return $items_compra;
                //return $factura;
            DB::commit();

            return view('facturas/factura_compra', compact('factura','clinica','cliente','items_compra'));

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
