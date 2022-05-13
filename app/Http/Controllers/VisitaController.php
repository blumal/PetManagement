<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;
use Illuminate\Support\Facades\Storage;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

use function Ramsey\Uuid\v1;

class VisitaController extends Controller
{   
    public function preRellenarVisitaClinica(Request $request){
        $id_user = $request->session()->get('id_user_session');
        $id_visita=$request->id_visita;
        if ($id_user=="") {
            return redirect('/');
        }else {
            try{
                DB::beginTransaction();
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

                    $id_usuario=$visita[0]->id_usuario_fk;

                    $id_paciente= $visita[0]->id_pacienteanimal_fk;

                    $cliente = DB::table('tbl_usuario')
                            ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
                            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                            ->where('id_us','=',$id_usuario)
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

        //VALIDACIONES LARAVEL
        /*
        $request->validate([
            'id_visita'=>'required|integer',
            'id_usuario'=>'required|integer',
            'promocion'=>'required|integer',
            'total_factura'=>'required|numeric|between:0,99999.99',
            'fecha_factura'=>'required|date_format:Y-m-d|after_or_equal:1920-01-01',
            'hora_factura'=>'date_format:H:i',
            'id_veterinario'=>'required|integer',
            'diagnostico'=>'required|string|min:8'
        ]); 
        */

        $id_visita=$request['id_visita'];
        $id_usuario=$request['id_usuario'];
        $id_promocion=$request['promocion'];
        $total_factura=$request['total_factura'];
        $fecha_factura=$request['fecha_factura'];
        $hora_factura=$request['hora_factura'];
        $id_veterinario=$request['id_veterinario'];
        $diagnostico = $request['diagnostico'];
        $num_items=count($request['productos']);

        $cliente = DB::table('tbl_usuario')
                            ->where('id_us','=',$id_usuario)
                            ->get();

        $email_cliente=$cliente[0]->email_us;

        
        
        DB::table('tbl_visita')
        ->where('id_vi', $id_visita)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update( [ 'diagnostico_vi' => $diagnostico] );

        DB::table('tbl_visita')
        ->where('id_vi', $id_visita)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update( [ 'id_estado_fk' => 3] );

        $id_factura = DB::table('tbl_factura_clinica')->insertGetId(
            [ 'id_usuario_fk' => $id_usuario,'id_visita_fk'=> $id_visita,'id_promocion_fk'=>$id_promocion,'total_fc'=>$total_factura,'fecha_fc'=>$fecha_factura,'hora_fc'=>$hora_factura,'id_veterinario_fk'=>$id_veterinario ]);
        for ($i=0; $i < $num_items; $i++) { 
            DB::insert('insert into tbl_detallefactura_clinica (cant_dfc,id_producto_fk,id_factura_fk) values (?,?,?)',
            [$request['cantidad'][$i],$request['productos'][$i],$id_factura]);
        }

        //Envío de mail
        $sub = "Confirmación de visita";
        $datas=[$hora_factura,$fecha_factura,$total_factura,$diagnostico];
        $enviar = new Mailtocustomers($datas);
        //,$total_factura,$localtime,$date
        $enviar->sub = $sub;
        Mail::to($email_cliente)->send($enviar);
        
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

    //CRUD PACIENTES
    public function VisitasAjax (Request $request){

        $animal_asociado = DB::table('tbl_visita')
            ->where('fecha_vi','=',$request->fecha_visita)
            ->get();

        for ($i=0; $i < count($animal_asociado); $i++) { 
            if ($animal_asociado[$i]->id_pacienteanimal_fk==null) {
                $visitas = DB::table('tbl_visita')
                    ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
                    ->where('fecha_vi','=',$request->fecha_visita)
                    ->where('id_Estado_fk','<',3)
                    ->get();
            }else{
                $visitas = DB::table('tbl_visita')
                    ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
                    ->join('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
                    ->where('fecha_vi','=',$request->fecha_visita)
                    ->where('id_Estado_fk','<',3)
                    ->get();
            }
        }
        
        
        return $visitas;
        
        /*$cliente = DB::table('tbl_usuario')
            ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
            ->where('id_us','=',$id_user)
            ->get();
            */
        
        return response()->json($visitas);
        //return $request;
    }
    
    public function asociarPacienteVisita(Request $request){
        try {
            DB::beginTransaction();

            $visita= DB::table('tbl_visita')
                        ->where('id_vi','=',$request['id_visita'])
                        ->get();

            $pacientes=DB::table('tbl_pacienteanimal_clinica')
                ->where('propietario_fk', $request['id_usuario'])
                ->get();

            $cliente = DB::table('tbl_usuario')
                ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
                ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
                ->where('id_us','=',$request['id_usuario'])
                ->get();

            DB::commit();
            
            return view('clinica/vistas/asociarPacienteVisita',compact('pacientes','visita','cliente'));

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function cerrarAsociacion(Request $request){
        
        try {
            DB::beginTransaction();

            DB::table('tbl_visita')
                ->where('id_vi', $request['id_visita'])  // find your user by their email
                ->limit(1)  // optional - to ensure only one record is updated.
                ->update( [ 'id_pacienteanimal_fk' => $request['id_paciente']] );

            DB::commit();
            return redirect('/citas');
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
    }

}
