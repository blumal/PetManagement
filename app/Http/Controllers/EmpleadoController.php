<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Mailtocustomers;
use Facade\Ignition\DumpRecorder\Dump;
use Illuminate\Support\Facades\Mail;
class EmpleadoController extends Controller
{
    public function empleadoDatas(){
        return view('empleados/filtrocitas');
    }

    //Vista calendario
    public function calendarEmp(){
        return view('empleados/calendaremp');
    }

    //Recogida de datos JSON de las citas

    public function showQuotes(){
        $today = now()->format('Y-m-d');
        $citas = DB::select("SELECT fecha_vi, hora_vi FROM tbl_visita WHERE fecha_vi >= '$today'");
        return response()->json($citas);
    }


    public function quotesFilter(Request $request){
        //Query citas
        $today = now()->format('Y-m-d');
        $quotes=DB::table("tbl_visita")
        //Leftjoin -> hay datos nulos
            ->leftJoin('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
            ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
            ->join('tbl_estado', 'tbl_visita.id_estado_fk', '=', 'tbl_estado.id_est')
            ->where('tbl_visita.fecha_vi', '>=', $today)
            ->where('tbl_estado.estado_est','!=', 'Finalizada')
            ->where('tbl_visita.id_vi', 'LIKE', '%'.$request->input('id_vi').'%')
            ->where('tbl_usuario.dni_us', 'LIKE', '%'.$request->input('dni_us').'%')
            ->get();
        return response()->json($quotes);
    }

    //Recogida datos de la visita
    public function quotesInfo($id_vi){
        $quotedatas = DB::table("tbl_visita")
            ->leftJoin('tbl_pacienteanimal_clinica', 'tbl_visita.id_pacienteanimal_fk', '=', 'tbl_pacienteanimal_clinica.id_pa')
            ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
            ->join('tbl_estado', 'tbl_visita.id_estado_fk', '=', 'tbl_estado.id_est')
            ->join('tbl_telefono', 'tbl_usuario.id_telefono_fk', '=', 'tbl_telefono.id_tel')
            ->where('tbl_visita.id_vi', '=', $id_vi)
            ->get();
        return view('empleados/infogestioncitas', compact('quotedatas'));
    }
    //Recogida de datos para poder editar en un futuro
    public function quotesEdit($id_vi){
        $quoteedit = DB::table("tbl_visita")
            ->join('tbl_usuario', 'tbl_visita.id_usuario_fk', '=', 'tbl_usuario.id_us')
            ->where('tbl_visita.id_vi', '=', $id_vi)
            ->get();
        return view('empleados/editcita', compact('quoteedit'));
    }

    //Actualizaci??n de datos de la cita
    public function updatequoteProc(Request $request){
        //Fecha actual
        $today = date("Y-m-d");

        //Validaci??n datos que se esperan
        $datas = $request->validate([
            'fecha_vi' => 'required|date|after_or_equal:today',
            'hora_vi' => 'required|string|max:5',
            'email_us' => 'required|string|max:70',
            'id_vi' => 'required|integer'
        ]);

        try {
            $checkdatas = DB::table('tbl_visita')
                ->where('fecha_vi', '=', $request['fecha_vi'])
                ->where('hora_vi', '=', $request['hora_vi'])
                ->count();
            if ($checkdatas < 3) {
                //Actualizaci??n de datos
                DB::update('UPDATE tbl_visita 
                    SET fecha_vi=?, hora_vi=?, id_estado_fk=? 
                    WHERE id_vi=?', 
                    [$request->input('fecha_vi'), $request->input('hora_vi'), 1, $request->input('id_vi')]);
                $sub = "Modificaci??n de cita";
                $enviar = new Mailtocustomers($datas, 1);
                $enviar->sub = $sub;
                Mail::to($request['email_us'])->send($enviar);
                return response()->json(array('result'=> 'OK'));
            }else{
                return response()->json(array('result'=> 'NOK'));
            }
        } catch (\Throwable $e) {
            return response()->json(array('result'=> 'NOK'.$e->getMessage()));
        }
    }

    //Actualizaci??n estado de cita
    public function updateStatus($id_vi){
        try {
            DB::table('tbl_visita')
                ->where('tbl_visita.id_vi', '=', $id_vi)
                ->update([
                    'id_estado_fk' => 2
                ]);
            return response()->json(array('result'=> 'OK'));
        } catch (\Throwable $e) {
            return response()->json(array('result'=> 'NOK'.$e->getMessage()));
        }
    }
    
    //Eliminaci??n de cita
    public function deleteQuote($id_vi){
        try {
            DB::table('tbl_visita')
                ->where('id_vi', $id_vi)
                ->delete();
            return response()->json(array('result'=> 'OK'));
        } catch (\Throwable $e) {
            return response()->json(array('result'=> 'NOK'.$e->getMessage()));
        }
    }
}
 