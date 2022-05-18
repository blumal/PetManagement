<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function empleadoDatas(){
        return view('empleados/filtrocitas');
    }

    public function quotesFilter(Request $request){
        //Query citas
        $today = now()->format('Y-m-d');
        $quotes=DB::table("tbl_visita")
            ->join('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
            ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
            ->join('tbl_estado', 'tbl_visita.id_estado_fk', '=', 'tbl_estado.id_est')
            ->where('tbl_visita.fecha_vi', '>=', $today)
            ->where('tbl_estado.estado_est','!=', 'Finalizada')
            ->where('tbl_visita.id_vi', 'LIKE', '%'.$request->input('id_vi').'%')
            ->where('tbl_usuario.dni_us', 'LIKE', '%'.$request->input('dni_us').'%')
            ->get();
        return response()->json($quotes);
    }
}
 