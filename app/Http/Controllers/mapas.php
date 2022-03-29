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
        $datos=DB::select('select * from tbl_establecimientos');
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

    
}
