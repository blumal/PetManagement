<?php

namespace App\Http\Controllers;

use App\Mail\Mailtocustomers;
use App\Models\Citas;
use Illuminate\Http\Request;
//Necesario para cualquier query
use Illuminate\Support\Facades\DB;
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

    //Login view
    public function login()
    {   
        return view('login/login');
    }

    //Funcion para limpiar todas las sesiones que tengamos encima
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }

    //Funcion para que el usuario modifique su perfil
    public function modificarPerfil(Request $request){
        $id=session('id_user_session');
        $profile = DB::select("select * FROM tbl_usuario
        INNER JOIN tbl_rol ON tbl_usuario.id_rol_fk=tbl_rol.id_ro
        INNER JOIN tbl_telefono on tbl_usuario.id_telefono_fk=tbl_telefono.id_tel
        INNER JOIN tbl_direccion on tbl_usuario.id_direccion1_fk=tbl_direccion.id_di
        where id_us={$id}");
        return view('perfil',compact('profile'));
    }

    public function modificarPerfilPost(Request $request){
        $datos=$request->except('_token','_method');
        try {
            DB::beginTransaction();
            DB::table('tbl_usuario')->where('id_us','=',$datos['id_us'])->update($datos);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        return redirect('perfil');
    }

    //Método encargado de hacer el proceso de login
    //$request es la variable encargada de traer todos los datos enviados desde un formulario
    public function loginProc(Request $request)
    {
        //return $request;
        //Validación de datos enviados desde el form, en este caso se verifica en el server
        $request->validate([
            'email_us' => 'required|string|max:70',
            'pass_us' => 'required|string|max:50'
        ]);

        try {
            //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
            $userId = $request->except('_token', '_method');
            $userId_compr=DB::table("tbl_usuario")
                ->join('tbl_rol', 'tbl_usuario.id_rol_fk', '=', 'tbl_rol.id_ro')
                ->where('tbl_usuario.email_us','=',$userId['email_us'])
                ->where('tbl_usuario.pass_us','=',$userId['pass_us'])
                ->get();
            //return $userId_compr;
            //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
            if ($userId_compr[0]->rol_ro=='trabajador'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $userId['pass_us'])->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('trabajador_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                return redirect('/');
            }else if($userId_compr[0]->rol_ro=='admin'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $userId['pass_us'])->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('admin_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                return redirect('/cpanel');
            }else if($userId_compr[0]->rol_ro=='cliente'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $userId['pass_us'])->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('cliente_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);

                //Envíamos los registros del usuario que ha iniciado sesión
                $an_asociado = DB::table('tbl_pacienteanimal_clinica')->where('propietario_fk', '=', $id_usuario)->get();
                $request->session()->put('animales_asociados', $an_asociado);
                $request->session()->put('id_rol_session', $rol_usuario);
                return redirect('/');
            }else{
                //No establecemos sesión y lo devolvemos a login
                return redirect('/login');
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
    //Obtenemos todas las citas de fecha actual y futuras, envíandolo por JSON

    /* public function loginP(Request $request){
        $datos= $request->except('_token','_method');
        $user=DB::table("tbl_rol")->join('tbl_user', 'tbl_rol.id', '=', 'tbl_user.id_rol')->where('correo_user','=',$datos['correo_user'])->where('pass_user','=',$datos['pass_user'])->first();
        if($user->nombre_rol=='Administrador'){
           $request->session()->put('nombre_admin',$request->correo_user);
           return redirect('cPanelAdmin');
        }if($user->nombre_rol=='Usuario'){
            $request->session()->put('nombre_user',$request->correo_user);
            return redirect('');
        }
        return redirect('');
    } */

    public function regisProc(Request $request){
        //return $request;
        //Validación de datos enviados desde el form, en este caso se verifica en el server
        $request->validate([
            'email_us' => 'required|string|max:70',
            'pass_us' => 'required|string|max:50'
        ]);

        try {
            //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
            $request->except('_token', '_method');
            //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
            if ($request->input('pass_us')==$request->input('pass2_us')){
                $pwd = hash( 'sha256', $request->input('pass_us') );
                DB::insert('insert into tbl_direccion (nombre_di, numero_di, bloque_di, piso_di, puerta_di, cp_di) values (?, ?. ?, ?, ?, ?)', 
                    [$request->input('dir_us'), 
                    $request->input('ndir_us'), 
                    $request->input('bdir_us'), 
                    $request->input('pdir_us'), 
                    $request->input('padir_us'), 
                    $request->input('cpdir_us')]);
                $id_dir = DB::getPdo()->lastInsertId();
                DB::insert('insert into tbl_telefono (nombre_di, numero_di) values (?, ?)', 
                        [$request->input('dir_us'), 
                        $request->input('ndir_us')]);
                $id_telf = DB::getPdo()->lastInsertId();
                DB::insert('insert into tbl_usuario (nombre_us, apellido1_us, apellido2_us, dni_us, email_us, pass_us, id_rol_fk, id_direccion1_fk, id_telelefono_fk) values (?, ?, ?, ?, ?, ?, ?, ?, ?)', 
                    [$request->input('name_us'), 
                    $request->input('apellido_us'), 
                    $request->input('apellido2_us'), 
                    $request->input('dni_us'), 
                    $request->input('email_us'), 
                    $pwd, 
                    2, 
                    $id_dir, 
                    $id_telf]);
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $request->input('email_us'))->where('pass_us', '=', $pwd)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('cliente_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                return redirect('/');
            }else {
                //No establecemos sesión y lo devolvemos a login
                return redirect('/registro');
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
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
                    Mail::to(session('email_session'))->send($enviar);
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

