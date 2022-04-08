<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;

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

                    $id_paciente= $visita[0]->id_pacienteanimal_fk;

                    $cliente = DB::table('tbl_usuario')
                            ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
                            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                            ->where('id_us','=',$id_user)
                            ->get();
                    
                    $paciente= DB::table('tbl_pacienteanimal_clinica')
                            ->where('id_pa','=',$id_paciente)
                            ->get();
    
                    $items_clinica=DB::table('tbl_producto_clinica')
                            ->get();

                    $promociones = DB::table('tbl_promocion')
                            ->get();
                    $productos_clinica = DB::table('tbl_factura_clinica')
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
            return view('facturas/crear/factura_visitaCrear',compact('cliente','visita','paciente','promociones','items_clinica'));
        }
    }
    public function RellenoVisita(Request $request){
        //return $request;
        $id_visita=$request['id_visita'];
        $id_usuario=$request['id_usuario'];
        $id_promocion=$request['promocion'];
        $total_factura=$request['total_factura'];
        $fecha_factura=$request['fecha_factura'];
        $hora_factura=$request['hora_factura'];

        $diagnostico = $request['diagnostico'];

        $num_items=count($request['productos']);



        DB::table('tbl_visita')
        ->where('id_vi', $id_visita)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update( [ 'diagnostico_vi' => $diagnostico] );

        $id_factura = DB::table('tbl_factura_clinica')->insertGetId(
            [ 'id_usuario_fk' => $id_usuario,'id_visita_fk'=> $id_visita,'id_promocion_fk'=>$id_promocion,'total_fc'=>$total_factura,'fecha_fc'=>$fecha_factura,'hora_fc'=>$hora_factura ]);
        for ($i=0; $i < $num_items; $i++) { 
            DB::insert('insert into tbl_detallefactura_clinica (cant_dfc,id_producto_fk,id_factura_fk) values (?,?,?)',
            [$request['cantidad'][$i],$request['productos'][$i],$id_factura]);
        }
        
        return redirect('/');
        

    }
    public function anadir_item_factura(Request $request){
        $items_clinica=DB::table('tbl_producto_clinica')
                            ->get();
        return $items_clinica;
        return response()->json($items_clinica);
    }
    public function calcular_total(Request $request){
        $array_ids_productos = explode (",", $request['productos']);
        $array_cantidades = explode (",", $request['cantidades']);
        $subtotal=0;
        $precios_totales = array();
        
        for ($i=0; $i < $request['no_items']; $i++) {
            
            $producto = DB::table('tbl_producto_clinica')
                            ->where('id_prod','=',$array_ids_productos[$i])
                            ->get();
            $precio_prod=$producto[0]->precio_pro;

            $int_precio_prod = (float)$precio_prod;
            $int_precio_prod = (float)$precio_prod;

            $precio=$int_precio_prod*(int)$array_cantidades[$i];
            $subtotal+=$precio;
        }
        $promo = DB::table('tbl_promocion')
            ->where('id_pro','=',$request['id_promo'])
            ->get();

        $total=$subtotal - (($promo[0]->porcentaje_pro/100)*$subtotal);
        $total_redondeado= round($total, 2);
        //return $total_redondeado;
        return response()->json($total_redondeado);
    }
}
