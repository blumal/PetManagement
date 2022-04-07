<?php

namespace App\Http\Controllers;

use App\Models\FacturaVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class FacturaVisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //FUNCION PARA MOSTRAR TODAS LAS FACTURAS CLINICAS DE UN USER
    public function directorioFacturasClinica(Request $request){
        $id_user= $request['id_user'];
        $facturas = DB::table('tbl_factura_clinica')
        ->where('id_usuario_fk','=',$id_user)
        ->get();

        return view('facturas/directorioFacturasClinica', compact('facturas'));
    }
    //FUNCION PARA MOSTRAR VER UNA FACTURA CLINICA
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

                $items_clinica=DB::table('tbl_detallefactura_clinica')
                ->join('tbl_producto_clinica', 'tbl_detallefactura_clinica.id_producto_fk', '=', 'tbl_producto_clinica.id_prod')
                ->where('id_factura_fk','=',$id_factura)
                ->get();
                //return $items_compra;
                //return $factura;
            DB::commit();

            return view('facturas/view/factura_visitaClinica', compact('factura','clinica','cliente','items_clinica'));

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }

    }

    //FUNCION PARA DESCRAGAR UNA FACTURAS CLINICA DE UN USER
    public function createPDFClinica(Request $request) {
        try{
            DB::beginTransaction();
                $id_factura= $request['id_factura_clinica'];
                $id_clinica=1;
                // retreive all records from db
                $clinica = DB::table('tbl_sociedad')
                        ->join('tbl_direccion', 'tbl_sociedad.id_direccion_fk', '=', 'tbl_direccion.id_di')
                        ->join('tbl_telefono', 'tbl_sociedad.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                        ->where('id_s','=',$id_clinica)
                        ->get();
                //return $id_factura;
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

                $items_clinica=DB::table('tbl_detallefactura_clinica')
                        ->join('tbl_producto_clinica', 'tbl_detallefactura_clinica.id_producto_fk', '=', 'tbl_producto_clinica.id_prod')
                        ->where('id_factura_fk','=',$id_factura)
                        ->get();
                $download=1;
                //$data = Employee::all();
                // share data to view
                //view()->share('clinica',$clinica);
                $pdf = PDF::loadView('facturas/view/factura_visitaClinica', compact('factura','clinica','cliente','items_clinica','download'));
                // download PDF file with download method
            DB::commit();
            return $pdf->download('facturaClinica-'.$id_factura.'.pdf');

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
}