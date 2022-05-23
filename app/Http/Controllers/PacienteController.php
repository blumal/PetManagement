<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Whoops\Run;
use Illuminate\Support\Facades\Storage;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

class PacienteController extends Controller
{
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
        $id_paciente=$request['id_paciente'];
        try {
            DB::beginTransaction();
            $paciente_desactualizado = DB::table('tbl_pacienteanimal_clinica')
                ->where('id_pa', $id_paciente)
                ->limit(1)
                ->update(
                    ['activo' => 0]
                );
            
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa',"=", $request['id_paciente'])->delete();
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa', '=',8)->delete();
            DB::commit();
            return response()->json("OK");
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }
    }
    public function activarPaciente(Request $request){
        $id_paciente=$request['id_paciente'];
        try {
            DB::beginTransaction();
            $paciente_desactualizado = DB::table('tbl_pacienteanimal_clinica')
                ->where('id_pa', $id_paciente)
                ->limit(1)
                ->update(
                    ['activo' => 1]
                );
            
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa',"=", $request['id_paciente'])->delete();
            //DB::table('tbl_pacienteanimal_clinica')->where('id_pa', '=',8)->delete();
            DB::commit();
            return response()->json("OK");
        } catch (\Exception $error) {
            DB::rollback();
            return $error -> getMessage();
        }
    }
    public function leerPacientes(Request $request){
        if ($request['nombre_paciente']==null) {
            $pacientes= DB::table('tbl_pacienteanimal_clinica')
                    ->join('tbl_usuario', 'tbl_pacienteanimal_clinica.propietario_fk', '=', 'tbl_usuario.id_us')
                    ->orderBy('activo','desc')
                    ->get();
        }else{
            $pacientes= DB::table('tbl_pacienteanimal_clinica')
                    ->join('tbl_usuario', 'tbl_pacienteanimal_clinica.propietario_fk', '=', 'tbl_usuario.id_us')
                    ->where('nombre_pa', 'like', '%'.$request['nombre_paciente'].'%')
                    ->orderBy('activo','desc')
                    ->get();
        }
        
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
