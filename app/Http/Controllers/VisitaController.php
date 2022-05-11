<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;
use Illuminate\Support\Facades\Storage;

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

        //VALIDACIONES LARAVEL
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


        $id_visita=$request['id_visita'];
        $id_usuario=$request['id_usuario'];
        $id_promocion=$request['promocion'];
        $total_factura=$request['total_factura'];
        $fecha_factura=$request['fecha_factura'];
        $hora_factura=$request['hora_factura'];
        $id_veterinario=$request['id_veterinario'];
        $diagnostico = $request['diagnostico'];

        $num_items=count($request['productos']);



        DB::table('tbl_visita')
        ->where('id_vi', $id_visita)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update( [ 'diagnostico_vi' => $diagnostico] );

        $id_factura = DB::table('tbl_factura_clinica')->insertGetId(
            [ 'id_usuario_fk' => $id_usuario,'id_visita_fk'=> $id_visita,'id_promocion_fk'=>$id_promocion,'total_fc'=>$total_factura,'fecha_fc'=>$fecha_factura,'hora_fc'=>$hora_factura,'id_veterinario_fk'=>$id_veterinario ]);
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

    //CRUD PACIENTES
    public function VisitasAjax (Request $request){

        $visitas = DB::table('tbl_visita')
            ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
            ->join('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
            ->where('fecha_vi','=',$request->fecha_visita)
            ->get();
        
        /*$cliente = DB::table('tbl_usuario')
            ->join('tbl_direccion', 'tbl_usuario.id_direccion1_fk', '=', 'tbl_direccion.id_di')
            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
            ->where('id_us','=',$id_user)
            ->get();
            */
        
        return response()->json($visitas);
        //return $request;
    }
    public function registrarPaciente(){

        try {
            $duenos= DB::table('tbl_usuario')
                    ->where('id_rol_fk','=',2)
                    ->get();
        } catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        //return view('facturas/crear/factura_visitaCrear',compact('cliente','visita','paciente','promociones','items_clinica'));
        return view('clinica/vistas/crearPaciente', compact('duenos'));
    }
    public function cerrarPaciente(Request $request){
        $foto = $request->hasFile('foto_paciente');

        $request->validate([
            'nombre_paciente'=>'required|string',
            'peso_paciente'=>'required|numeric|between:0,9999.99',
            'fecha_nacimiento_paciente'=>'required|date_format:Y-m-d|after_or_equal:1800-01-01',
            'id_dueno_paciente'=>'required|integer',
            'nombre_cientifico_paciente'=>'required|string'
        ]); 

        $datos = $request->except('_token');
        
        if ($foto) {
            $datos['foto_paciente'] = $request->file('foto_paciente')->store('uploads','public');
        }else{
            //Aqui venimos si no hay ninguna foto a la hora de subir la foto de la persona
            $datos['foto_paciente'] = "uploads/incognito.png";
        }

        try {
            DB::beginTransaction();

            DB::insert('insert into tbl_pacienteanimal_clinica (nombre_pa, peso_pa,n_id_nacional,fecha_nacimiento,foto_pa,propietario_fk,nombrecientifico_pa,raza_pa)
            values (?, ?, ?, ?, ?, ?, ?, ?)',
            [$datos['nombre_paciente'], $datos['peso_paciente'], $datos['nirn_paciente'], $datos['fecha_nacimiento_paciente'], $datos['foto_paciente'], $datos['id_dueno_paciente'], $datos['nombre_cientifico_paciente'], $datos['raza_paciente']]);

            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }

        return redirect('/adminPacientes');
    }
    public function adminPacientes(){
        try {
            DB::beginTransaction();
            $pacientes = DB::select("select * FROM tbl_pacienteanimal_clinica
        INNER JOIN tbl_usuario ON tbl_pacienteanimal_clinica.propietario_fk=tbl_usuario.id_us");
            /* $pacientes= DB::table('tbl_pacienteanimal_clinica')
                    ->join('tbl_usuario', 'tbl_pacienteanimal_clinica.propietario_fk', '=', 'tbl_usuario.id_us')
                    ->get(); */
            DB::commit();
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }
        
        return view('clinica/vistas/adminPacientes', compact('pacientes'));   
    }
    public function eliminarPaciente(Request $request){
        try {
            DB::beginTransaction();
            $id_paciente=$request['id_paciente'];
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa',"=", $request['id_paciente'])->delete();
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa', '=',8)->delete();
            DB::delete('delete from tbl_pacienteanimal_clinica where id_pa = ?',[$id_paciente]);
            DB::commit();
            return response()->json("OK");
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }
    }
    public function leerPacientes(){
        $pacientes= DB::table('tbl_pacienteanimal_clinica')
                    ->join('tbl_usuario', 'tbl_pacienteanimal_clinica.propietario_fk', '=', 'tbl_usuario.id_us')
                    ->get();
        return response()->json($pacientes);
        
    }
    public function editarPaciente(Request $request){
        $id_paciente=$request['id_paciente'];
    
        try{
            DB::beginTransaction();
                // retreive all records from db
                $paciente= DB::table('tbl_pacienteanimal_clinica')
                    ->join('tbl_usuario', 'tbl_pacienteanimal_clinica.propietario_fk', '=', 'tbl_usuario.id_us')
                    ->where('id_pa','=',$id_paciente)
                    ->get();
                $duenos= DB::table('tbl_usuario')
                    ->where('id_rol_fk','=',2)
                    ->get();
                
                //return $id_factura;

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        //return $paciente;
        return view('clinica/vistas/editarPaciente',compact('paciente','duenos'));
    }
    public function cerrarPacienteEditar (Request $request){
        $id_paciente = $request['id_paciente'];

        $request->validate([
            'nombre_paciente'=>'required|string',
            'peso_paciente'=>'required|numeric|between:0,9999.99',
            'fecha_nacimiento_paciente'=>'required|date_format:Y-m-d|after_or_equal:1800-01-01',
            'id_dueno_paciente'=>'required|integer',
            'nombre_cientifico_paciente'=>'required|string'
        ]);

        if (isset($request['foto_paciente'])) {
            $foto_paciente = $request->file('foto_paciente')->store('uploads','public');
            if ($request['foto_paciente_old']=='uploads/incognito.png') {
                # code...
            }else{
                Storage::delete('public/'.$request['foto_paciente_old']); 
            }
            
            
            //$foto_paciente=$request['foto_paciente'];
        }else{
            $foto_paciente=$request['foto_paciente_old'];
        }

        try {
            DB::beginTransaction();

            $paciente_actualizado = DB::table('tbl_pacienteanimal_clinica')
                ->where('id_pa', $id_paciente)
                ->limit(1)
                ->update(
                    ['nombre_pa' => $request['nombre_paciente'],
                    'peso_pa' => $request['peso_paciente'],
                    'n_id_nacional' => $request['nirn_paciente'],
                    'fecha_nacimiento' => $request['fecha_nacimiento_paciente'],
                    'foto_pa' => $foto_paciente,
                    'propietario_fk' => $request['id_dueno_paciente'],
                    'nombrecientifico_pa' => $request['nombre_cientifico_paciente'],
                    'raza_pa' => $request['raza_paciente']]
                );

            DB::commit();
            return redirect('/adminPacientes');

        }catch(\Exception $e){
            DB::rollBack();
            return $e->getMessage();
        }
        

        
    }
}
