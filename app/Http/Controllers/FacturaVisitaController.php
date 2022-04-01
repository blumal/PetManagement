<?php

namespace App\Http\Controllers;

use App\Models\FacturaVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FacturaVisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function directorioFacturasClinica(Request $request){
        $id_user=1;
        $facturas = DB::table('tbl_factura_clinica')
        ->where('id_usuario_fk','=',$id_user)
        ->get();

        return view('facturas/directorioFacturasClinica', compact('facturas'));
    }
    public function vistaFacturaClinica(Request $request){
        $id_factura= $request['id_factura_clinica'];
        $id_clinica=1;

        try{
            DB::beginTransaction();
                $clinica = DB::table('tbl_sociedad')
                ->join('tbl_direccion', 'tbl_sociedad.id_direccion_fk', '=', 'tbl_direccion.id_di')
                ->join('tbl_telefono', 'tbl_sociedad.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                ->where('id_s','=',$id_clinica)
                ->get();

                $factura = DB::table('tbl_factura_clinica')
                ->where('id_fc','=',$id_factura)
                ->join('tbl_promocion', 'tbl_factura_clinica.id_promocion_fk', '=', 'tbl_promocion.id_pro')
                ->get();
                //return $factura;
                $id_user=$factura[0]->id_usuario_fk;

                $cliente = DB::table('tbl_usuario')
                ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
                ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                ->where('id_us','=',$id_user)
                ->get();

                $items_compra=DB::table('tbl_detallefactura_tienda')
                ->where('id_factura_tienda_fk','=',$id_factura)
                ->join('tbl_articulo_tienda', 'tbl_detallefactura_tienda.id_articulo_fk', '=', 'tbl_articulo_tienda.id_art')
                ->get();
                //return $items_compra;
                //return $factura;
            DB::commit();

            return view('facturas/view/factura_compraTienda', compact('factura','clinica','cliente','items_compra'));

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
     * @param  \App\Models\FacturaVisita  $facturaVisita
     * @return \Illuminate\Http\Response
     */
    public function show(FacturaVisita $facturaVisita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FacturaVisita  $facturaVisita
     * @return \Illuminate\Http\Response
     */
    public function edit(FacturaVisita $facturaVisita)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FacturaVisita  $facturaVisita
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FacturaVisita $facturaVisita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FacturaVisita  $facturaVisita
     * @return \Illuminate\Http\Response
     */
    public function destroy(FacturaVisita $facturaVisita)
    {
        //
    }
}
