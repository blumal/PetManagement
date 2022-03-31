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
        $datos=DB::select('SELECT tbl_sociedad.nombre_s, tbl_sociedad.email_s, tbl_sociedad.horario_apertura_s, tbl_sociedad.horario_cierre_s, tbl_telefono.contacto1_tel, tbl_telefono.contacto2_tel, tbl_direccion.nombre_di, tbl_direccion.numero_di, tbl_direccion.cp_di FROM `tbl_sociedad`
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


    public function filtroMapasEstablecimientos(){
        //Guardamos en la variable datos los resultados de la consulta de la tabla establecimientos
        $datos=DB::select('select * from tbl_establecimientos');
        //Devolvemos por json los datos guardados en la variable datos
        return response()->json($datos);
    }
    
}
