<?php

namespace App\Http\Controllers;

use App\Models\Estadistica;
use Illuminate\Http\Request;
//Necesario para cualquier query
use Illuminate\Support\Facades\DB;

class EstadisticaController extends Controller
{
    public function test(){
        $visitas = DB::table('tbl_visita')
        ->get();

        $marcas = DB::table('tbl_marca')
        ->get();



        return view('estadisticas/stats', compact('visitas','marcas'));
    }
    public function leerStats(){
        $compras_por_mes = DB::select("SELECT MONTH(fecha_ft) MONTH, COUNT(*) COUNT 
        FROM tbl_factura_tienda
        GROUP BY MONTH(fecha_ft)");
        

        return response()->json($compras_por_mes);
    }
    public function visitas_por_horas(){
        $visitas_por_hora = DB::select("SELECT hour(hora_vi) hour, COUNT(*) COUNT 
        FROM tbl_visita GROUP BY hour(hora_vi);");

        return response()->json($visitas_por_hora);
    }
    public function animales_por_especie(){
        $especies = DB::select("SELECT DISTINCT nombrecientifico_pa from tbl_pacienteanimal_clinica;
        ");
        $contador_especies = DB::select("select COUNT(nombrecientifico_pa) as cont,nombrecientifico_pa from tbl_pacienteanimal_clinica group by nombrecientifico_pa;
        ");

        $result=[$especies,$contador_especies];
        return response()->json($result);

    }
    public function visitas_por_meses(){
        $visitas_por_mes = DB::select("SELECT MONTH(fecha_fc) MONTH, COUNT(*) COUNT 
        FROM tbl_factura_clinica
        GROUP BY MONTH(fecha_fc)");
        

        return response()->json($visitas_por_mes);
    }
    public function tipos_sociedades(){
        
        $contador_sociedades = DB::select("select COUNT(id_tipo_sociedad_fk) as cont,id_tipo_sociedad_fk, tbl_tipo_sociedad.sociedad_ts from tbl_sociedad inner join tbl_tipo_sociedad on tbl_sociedad.id_tipo_sociedad_fk=tbl_tipo_sociedad.id_ts GROUP by sociedad_ts,id_tipo_sociedad_fk");
        

        return response()->json($contador_sociedades);
    }
}


