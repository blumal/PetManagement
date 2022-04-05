<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Image;

class mapas extends Controller
{
    public function mapa_establecimientos(){
        //Le devolvemos a la vista del mapa que muestra los establecimientos
        return view('mapa_establecimientos');
    }

    public function markersEstablecimientos(){
        //Guardamos en la variable datos los resultados de la consulta de la tabla establecimientos
        $datos=DB::select('SELECT tbl_sociedad.*, tbl_telefono.*, tbl_direccion.* FROM `tbl_sociedad`
        INNER JOIN tbl_telefono ON tbl_sociedad.id_telefono_fk = tbl_telefono.id_tel
        INNER JOIN tbl_direccion ON tbl_sociedad.id_direccion_fk = tbl_direccion.id_di
        WHERE tbl_sociedad.operatividad_s = 1;');
        //Devolvemos por json los datos guardados en la variable datos
        return response()->json($datos);
    }

    public function mapa_animales_perdidos(){
        //Le devolvemos a la vista del mapa que muestra los animales perdidos
        return view('mapa_establecimientos');
    }

    public function markersAnimalesPerdidos(){
        //Guardamos en la variable datos los resultados de la consulta de la tabla animales perdidos
        $datos=DB::select('select * from tbl_animales_perdidos');
        //Devolvemos por json los datos guardados en la variable datos
        return response()->json($datos);
    }

    public function adminMapasEstablecimientos(){
        //Lo llevamos a la vista de admin
        return view('admin_mapa_establecimientos');
    }

    public function filtroMapasEstablecimientos(Request $request){
        //Guardamos en la variable datos los resultados de la consulta de la tabla establecimientos
        $datos=DB::select('SELECT tbl_sociedad.*, tbl_telefono.*, tbl_direccion.*, tbl_tipo_sociedad.* FROM `tbl_sociedad` 
        INNER JOIN tbl_telefono ON tbl_sociedad.id_telefono_fk = tbl_telefono.id_tel 
        INNER JOIN tbl_direccion ON tbl_sociedad.id_direccion_fk = tbl_direccion.id_di
        INNER JOIN tbl_tipo_sociedad ON tbl_sociedad.id_tipo_sociedad_fk = tbl_tipo_sociedad.id_ts
        WHERE tbl_sociedad.nombre_s like ? ORDER BY tbl_sociedad.nombre_s ASC', ['%'.$request->input('filtro').'%']);
        //Devolvemos por json los datos guardados en la variable datos
        return response()->json($datos);
    }

    public function modificarMapasEstablecimientos(Request $request){
        try {
            /* DB::table('tbl_tipo_sociedad')->where('id_ts','=',$request['id_ts'])
            ->update(['sociedad_ts' => $request['sociedad_ts']]);
            DB::table('tbl_direccion')->where('id_di','=',$request['id_di'])
            ->update(['nombre_di' => $request['nombre_di'], 'numero_di' => $request['numero_di'], 'puerta_di' => $request['puerta_di'], 'cp_di' => $request['cp_di']]);
            DB::table('tbl_telefono')->where('id_tel','=',$request['id_tel'])
            ->update(['contacto1_tel' => $request['contacto1_tel'], 'contacto2_tel' => $request['contacto2_tel']]); */
            if ($request->hasFile('foto_sociedad')) {
                $path = $request->image->store('public');
                Image::create(['path'=>$path]);
                DB::table('tbl_sociedad')->where('id_s','=',$request['id_s'])
            ->update(['nombre_s' => $request['nombre_s'],'nif_s' => $request['nif_s'],'email_s' => $request['email_s'],
            'horario_apertura_s' => $request['horario_apertura_s'],'horario_cierre_s' => $request['horario_cierre_s'],
            'url_web' => $request['url_web'], 'foto_icono_sociedad' => $request->file('foto_icono_sociedad')->getClientOriginalName(),
            'operatividad_s' => $request['operatividad_ts']]);
            }else if ($request['foto_icono_sociedad'] == NULL) {
                DB::table('tbl_sociedad')->where('id_s','=',$request['id_s'])
                ->update(['nombre_s' => $request['nombre_s'],'nif_s' => $request['nif_s'],'email_s' => $request['email_s'],
                'horario_apertura_s' => $request['horario_apertura_s'],'horario_cierre_s' => $request['horario_cierre_s'],
                'url_web' => $request['url_web'],'foto_sociedad' => $request->file('foto_sociedad')->getClientOriginalName(),
                'operatividad_s' => $request['operatividad_ts']]);
            }else if ($request->file('foto_sociedad')->getClientOriginalName() == NULL && $request->file('foto_icono_sociedad')->getClientOriginalName() == NULL) {
                DB::table('tbl_sociedad')->where('id_s','=',$request['id_s'])
                ->update(['nombre_s' => $request['nombre_s'],'nif_s' => $request['nif_s'],'email_s' => $request['email_s'],
                'horario_apertura_s' => $request['horario_apertura_s'],'horario_cierre_s' => $request['horario_cierre_s'],
                'url_web' => $request['url_web'], 'operatividad_s' => $request['operatividad_ts']]);
            }else{
                DB::table('tbl_sociedad')->where('id_s','=',$request['id_s'])
                ->update(['nombre_s' => $request['nombre_s'],'nif_s' => $request['nif_s'],'email_s' => $request['email_s'],
                'horario_apertura_s' => $request['horario_apertura_s'],'horario_cierre_s' => $request['horario_cierre_s'],
                'url_web' => $request['url_web'],'foto_sociedad' => $request->file('foto_sociedad')->getClientOriginalName(),'foto_icono_sociedad' => $request->file('foto_icono_sociedad')->getClientOriginalName(),
                'operatividad_s' => $request['operatividad_ts']]);
            }
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    
    public function crearMapasEstablecimientos(Request $request){
        try {
            $datos = DB::select('SELECT tbl_sociedad.*, tbl_telefono.*, tbl_direccion.*, tbl_tipo_sociedad.* FROM `tbl_sociedad` 
            INNER JOIN tbl_telefono ON tbl_sociedad.id_telefono_fk = tbl_telefono.id_tel 
            INNER JOIN tbl_direccion ON tbl_sociedad.id_direccion_fk = tbl_direccion.id_di
            INNER JOIN tbl_tipo_sociedad ON tbl_sociedad.id_tipo_sociedad_fk = tbl_tipo_sociedad.id_ts
            WHERE tbl_sociedad.nif_s like ?', ['%'.$request->input('nif').'%']);
            if ($datos != NULL) {
                return response()->json(array('resultado'=> 'NOK: Sociedad ya existente(NIF repetido)'));
            }else{
                DB::insert('insert into tbl_tipo_sociedad (sociedad_ts) values (?)',
                [$request->input('tipo')]);
                $id_tipo = DB::getPdo()->lastInsertId();
                DB::insert('insert into tbl_direccion (nombre_di, numero_di, cp_di) values (?, ?, ?)',
                [$request->input('direccion'), $request->input('num'), $request->input('cp')]);
                $id_direccion = DB::getPdo()->lastInsertId();
                DB::insert('insert into tbl_telefono (contacto1_tel, contacto2_tel) values (?, ?)',
                [$request->input('telf'), $request->input('telf2')]);
                $id_tlf = DB::getPdo()->lastInsertId();
                DB::insert('insert into tbl_sociedad (nombre_s, nif_s, email_s, id_tipo_sociedad_fk, id_direccion_fk, id_telefono_fk, 
                horario_apertura_s, horario_cierre_s, url_web, foto_sociedad, foto_icono_sociedad, operatividad_s) 
                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [$request->input('nombre'),  $request->input('nif'),  $request->input('email'), $id_tipo, $id_direccion, $id_tlf, 
                $request->input('horario_aper'), $request->input('horario_cierre'), $request->input('url_web'), $request->input('foto'),
                $request->input('foto_icono'), $request->input('operativo')]);
                return response()->json(array('resultado'=> 'OK'));
            }
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function eliminarMapasEstablecimientos(Request $request){
        try {
            DB::delete('delete from tbl_sociedad where id_s = ?', [$request->input('id_s')]);
            DB::delete('delete from tbl_tipo_sociedad where id_ts = ?', [$request->input('id_ts')]);
            DB::delete('delete from tbl_direccion where id_di = ?', [$request->input('id_di')]);
            DB::delete('delete from tbl_telefono where id_tel = ?', [$request->input('id_tel')]);
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
}
