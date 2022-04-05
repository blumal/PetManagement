<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller
{
    public function preRellenarVisitaClinica(Request $request){
        $id_user = $request->session()->get('id_user_session');
        if ($id_user=="") {
            return redirect('/');
        }else {
            try{
                DB::beginTransaction();
                    $id_visita= 1;
                    $id_clinica=1;
                    // retreive all records from db
                    $clinica = DB::table('tbl_sociedad')
                            ->join('tbl_direccion', 'tbl_sociedad.id_direccion_fk', '=', 'tbl_direccion.id_di')
                            ->join('tbl_telefono', 'tbl_sociedad.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                            ->where('id_s','=',$id_clinica)
                            ->get();
                    //return $id_factura;

                    $visita= DB::table('tbl_visita')
                    ->where('id_vi','=',$id_visita)
                    ->get();
    
                    $cliente = DB::table('tbl_usuario')
                            ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
                            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                            ->where('id_us','=',$id_user)
                            ->get();
    
                    $items_clinica=DB::table('tbl_detallefactura_clinica')
                            ->join('tbl_producto_clinica', 'tbl_detallefactura_clinica.id_producto_fk', '=', 'tbl_producto_clinica.id_prod')
                            ->get();
                    $download=1;
                    //$data = Employee::all();
                    // share data to view
                    //view()->share('clinica',$clinica);
                    // download PDF file with download method
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                return $e->getMessage();
            }
            return view('facturas/crear/factura_visitaCrear',compact('cliente','visita'));
        }
    }
}
