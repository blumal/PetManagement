<?php

namespace App\Http\Controllers;

use App\Models\FacturaCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FacturaCompraController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //FUNCION PARA MOSTRAR TODAS LAS FACTURAS DE COMPRAS DE UN USER
    public function directorioFacturasTienda(Request $request){
        $id_user= $request['id_user'];
        
        $facturas = DB::table('tbl_factura_tienda')
        ->where('id_usuario_fk','=',$id_user)
        ->get();

        return view('facturas/directorioFacturasTienda', compact('facturas'));
        
    }
    //FUNCION PARA MOSTRAR UNA FACTURA DE COMPRA DE UN USER
    public function vistaFacturaTienda(Request $request){
        $id_factura= $request['id_factura_tienda'];
        $id_clinica=1;
        try{
            DB::beginTransaction();
                $clinica = DB::table('tbl_sociedad')
                ->join('tbl_direccion', 'tbl_sociedad.id_direccion_fk', '=', 'tbl_direccion.id_di')
                ->join('tbl_telefono', 'tbl_sociedad.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                ->where('id_s','=',$id_clinica)
                ->get();

                $factura = DB::table('tbl_factura_tienda')
                ->where('id_ft','=',$id_factura)
                ->join('tbl_promocion', 'tbl_factura_tienda.id_promocion_fk', '=', 'tbl_promocion.id_pro')
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

    //FUNCION PARA DESCARGAR UNA FACTURA DE COMPRA DE UN USER
    public function createPDFTienda(Request $request) {
        $id_factura= $request['id_factura_tienda'];
        $id_clinica=1;
        try{
            DB::beginTransaction();
                // retreive all records from db
                $clinica = DB::table('tbl_sociedad')
                        ->join('tbl_direccion', 'tbl_sociedad.id_direccion_fk', '=', 'tbl_direccion.id_di')
                        ->join('tbl_telefono', 'tbl_sociedad.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                        ->where('id_s','=',$id_clinica)
                        ->get();

                $factura = DB::table('tbl_factura_tienda')
                        ->where('id_ft','=',$id_factura)
                        ->join('tbl_promocion', 'tbl_factura_tienda.id_promocion_fk', '=', 'tbl_promocion.id_pro')
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
                $download=1;
                //$data = Employee::all();
                // share data to view
                //view()->share('clinica',$clinica);
                $pdf = PDF::loadView('facturas/view/factura_compraTienda',compact('factura','clinica','cliente','items_compra','download'));
            // download PDF file with download method
            DB::commit();

            return $pdf->download('facturaCompra-'.$id_factura.'.pdf');

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }         
    }
}
