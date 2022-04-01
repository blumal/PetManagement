<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class mapas extends Controller
{
    public function mapa_establecimientos(){
        //Le devolvemos a la vista del mapa que muestra los establecimientos
        return view('mapa_establecimientos');
    }

    public function markersEstablecimientos(){
        //Guardamos en la variable datos los resultados de la consulta de la tabla establecimientos
        $datos=DB::select('SELECT tbl_sociedad.nombre_s, tbl_sociedad.nif_s, tbl_sociedad.email_s, tbl_sociedad.horario_apertura_s, tbl_sociedad.horario_cierre_s, tbl_telefono.contacto1_tel, tbl_telefono.contacto2_tel, tbl_direccion.nombre_di, tbl_direccion.numero_di, tbl_direccion.cp_di FROM `tbl_sociedad`
        INNER JOIN tbl_telefono ON tbl_sociedad.id_telefono_fk = tbl_telefono.id_tel
        INNER JOIN tbl_direccion ON tbl_sociedad.id_direccion_fk = tbl_direccion.id_di;');
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
        $datos=DB::select('SELECT tbl_sociedad.id_s, tbl_sociedad.nombre_s, tbl_sociedad.nif_s, tbl_sociedad.email_s, tbl_sociedad.horario_apertura_s, tbl_sociedad.horario_cierre_s, tbl_telefono.id_tel, tbl_telefono.contacto1_tel, tbl_telefono.contacto2_tel, tbl_direccion.id_di, tbl_direccion.nombre_di, tbl_direccion.numero_di, tbl_direccion.cp_di, tbl_tipo_sociedad.id_ts, tbl_tipo_sociedad.sociedad_ts FROM `tbl_sociedad` 
        INNER JOIN tbl_telefono ON tbl_sociedad.id_telefono_fk = tbl_telefono.id_tel 
        INNER JOIN tbl_direccion ON tbl_sociedad.id_direccion_fk = tbl_direccion.id_di
        INNER JOIN tbl_tipo_sociedad ON tbl_sociedad.id_tipo_sociedad_fk = tbl_tipo_sociedad.id_ts
        WHERE tbl_sociedad.nombre_s like ?', ['%'.$request->input('filtro').'%']);
        //Devolvemos por json los datos guardados en la variable datos
        return response()->json($datos);
    }

    public function modificarMapasEstablecimientos(Request $request){
        try {
            DB::table('tbl_tipo_sociedad')->where('id_ts','=',$request['id_ts'])
            ->update(['sociedad_ts' => $request['tipo_s']]);
            DB::table('tbl_direccion')->where('id_di','=',$request['id_di'])
            ->update(['nombre_di' => $request['nombre_di'], 'numero_di' => $request['numero_di'], 'puerta_di' => $request['puerta_di'], 'cp_di' => $request['cp_di']]);
            DB::table('tbl_telefono')->where('id_tel','=',$request['id_tel'])
            ->update(['contacto1_tel' => $request['contacto1_tel'], 'contacto2_tel' => $request['contacto2_tel']]);
            DB::table('tbl_sociedad')->where('id_s','=',$request['id_s'])
            ->update(['nombre_s' => $request['nombre_s'],'nif_s' => $request['nif_s'],'email_s' => $request['email_s'],'horario_apertura_s' => $request['horario_apertura_s'],'horario_cierre_s' => $request['horario_cierre_s']]);
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    
}
