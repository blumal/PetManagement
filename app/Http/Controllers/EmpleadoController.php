<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    public function empleadoDatas(){
        //Query citas
        $today = now()->format('Y-m-d');
        $quotes=DB::table("tbl_visita")
                ->join('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
                ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
                ->join('tbl_estado', 'tbl_visita.id_estado_fk', '=', 'tbl_estado.id_est')
                ->where('tbl_visita.fecha_vi', '>=', $today)
                ->where('tbl_estado.estado_est','!=', 'Finalizada' )
                ->get();
        return view('empleados/filtrocitas', compact('quotes'));
       /*  return $quotes; */
    }
}
 