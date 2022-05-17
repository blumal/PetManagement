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
        $id_user=$request->session()->get('id_user_session');
        if (isset($id_user)) {
            $facturas = DB::table('tbl_factura_clinica')
                ->where('id_usuario_fk','=',$id_user)
                ->get();
        }else{
            return redirect('/login');
            
        }
        

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
                $visita=DB::table('tbl_factura_clinica')
                ->join('tbl_visita', 'tbl_factura_clinica.id_visita_fk', '=', 'tbl_visita.id_vi')
                ->where('id_fc','=',$id_factura)
                ->get();
            DB::commit();

            return view('facturas/view/factura_visitaClinica', compact('factura','clinica','cliente','items_clinica','visita'));

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
                $visita=DB::table('tbl_factura_clinica')
                        ->join('tbl_visita', 'tbl_factura_clinica.id_visita_fk', '=', 'tbl_visita.id_vi')
                        ->where('id_fc','=',$id_factura)
                        ->get();
                $download=1;
                //$data = Employee::all();
                // share data to view
                //view()->share('clinica',$clinica);
                $pdf = PDF::loadView('facturas/view/factura_visitaClinica', compact('factura','clinica','cliente','items_clinica','download','visita'));
                // download PDF file with download method
            DB::commit();
            return $pdf->download('facturaClinica-'.$id_factura.'.pdf');

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function ruleta(){
        return view('ruleta');
    }

    public function ruleta_promo(){
        $datos = DB::select('SELECT * FROM tbl_promocion WHERE ruleta_pro = 1');
        return response()->json($datos);
    }

    public function comprobar_compra(Request $request){
        $datos = DB::select('SELECT COUNT(id_fc) AS id_fc FROM tbl_factura_clinica 
        WHERE id_usuario_fk = ?', [$request['id_usr']]);
        return response()->json($datos);
    }

    public function comprobar_promo(Request $request){
        $datos = DB::select('SELECT comprobar_cli_pro FROM tbl_clientes_promo WHERE fk_id_us = ?', [$request['id_usr']]);
        return response()->json($datos);
    }

    public function premio(Request $request){
        try {
            DB::table('tbl_clientes_promo')->where('fk_id_us','=',$request['id_usr'])
            ->update(['comprobar_cli_pro' => 1]);
                return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}
