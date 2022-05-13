<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
//Necesario para cualquier query
use Illuminate\Support\Facades\DB;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $this->sendMail();
    }
    
    //Vista citas
    public function Citas(){
        return view('clinica/vistas/citas');
    }

    //Vista cpanel
    public function cpanel(){
        return view('secciones');
    }

    public function cpanelUsrs(){
        //Falta
        /* return view(''); */
    }
    public function cpanelTienda(){
        return view('admincrud'); 
    }
    public function cpanelAnimales(){
        return view('clinica/vistas/adminPacientes');
    }
    public function cpanelAnimalesPerdidos(){
        //Falta
        /* return view(''); */
    }
    
    public function cpanelMapa(){
        return view('admin_mapa_establecimientos');
    }

    public function an_perd(){
        return view('animales_perdidos');
    }

    //Resultados actuales o futuros implementados en la api
    public function showcitas(){
        $today = now()->format('Y-m-d');
        $citas = DB::select("SELECT fecha_vi, hora_vi FROM tbl_visita WHERE fecha_vi >= '$today'");
        return response()->json($citas);
    }

    //Inserción datos a DB
    public function insertCita(Request $request){
        //Fecha actual
        $today = date("Y-m-d");
        $datas = $request->validate([
            //Validación de fecha actual o superior
            'fecha_vi' => 'required|date|after_or_equal:today',
            'hora_vi' => 'required|string|max:5',
            'asunto_vi' => 'required|string',
            'id_us' => 'required|integer'
        ]);
       /*  return $datas; */
        
        try {
            //$checkdatas = DB::select('SELECT fecha_vi, hora_vi FROM tbl_visitia WHERE fecha_vi = ? AND hora_vi = ?', [$request->input('fecha_vi'), $request->input('hora_vi')])->get();
            //Recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
            $estado = DB::select("SELECT id_est FROM tbl_estado WHERE estado_est = 'Agendada'");
            //Debugamos el resultado de la query, ya que únicamente nos interesa el valor del campo, para posteriormente utilizarlo en la query de inserción
            $estadodebug = $estado[0]->id_est;
            //print_r($estado);
            $checkdatas = $request->except('_token', '_method');
            $checkingdatas  = DB::table('tbl_visita')
                ->where('fecha_vi', '=', $checkdatas['fecha_vi'])
                ->where('hora_vi', '=', $checkdatas['hora_vi'])
                ->count();
            $customerbooks = DB::table('tbl_visita')
                ->where('fecha_vi', '=', $checkdatas['fecha_vi'])
                ->where('hora_vi', '=', $checkdatas['hora_vi'])
                ->where('id_usuario_fk', '=', $checkdatas['id_us'])
                ->count();
            //Definimos menor que 3 citas al mismo tiempo ya que como máximo se podrán atender 3 citas por diferentes veterinarios
            if ($checkingdatas  < 3) {
                //Comprobamos que el mismo usuario no pueda hacer la misma visita + de una vez
                if($customerbooks == 0){
                    DB::insert('insert into tbl_visita (fecha_vi, hora_vi, asunto_vi, id_pacienteanimal_fk, id_usuario_fk, id_estado_fk) values (?, ?, ?, ?, ?, ?)', 
                    [$request->input('fecha_vi'), 
                    $request->input('hora_vi'), 
                    $request->input('asunto_vi'),
                    $request->input('an_asociado'),
                    $request->input('id_us'),
                    $estadodebug]);
                    //Envío de mail
                    $sub = "Confirmación de cita";
                    $enviar = new Mailtocustomers($datas);
                    $enviar->sub = $sub;
                    Mail::to(session('cliente_session'))->send($enviar);
                    /* Mail::to(session('email_session'))->send(new Mailtocustomers($datas)); */
                    return response()->json(array('resultado'=> 'OK'));
                }else{
                    return response()->json(array('resultado'=> 'NOK'));
                }
            }
            /* Mail::to('alfredoblumtorres@gmail.com')->send(new Mailtocustomers); */
        } catch (\Exception $e) {
            return response()->json(array('resultado'=> 'NOK: '.$e->getMessage()));
        }
      }  
  
}

