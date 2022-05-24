<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class UsuarioController extends Controller
{
    //Login view
    public function login(Request $request)
    {   
        if ($request->route('id')==1) {
            $id = $request->route('id');
            return view('login/login',compact('id'));
        }else{
            $id = null;
            return view('login/login',compact('id'));
        }
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
        return view('login/editarPerfil',compact('profile'));
    }

    public function modificarPerfilPost(Request $request){
        $datos=$request->except('_token','_method');

        $datos_usuario=DB::table("tbl_usuario")
            ->where('email_us','=',$request['email_us']) 
            ->get();

        DB::table("tbl_usuario")
            ->where('email_us','=',$datos['email_us'])
            ->update(
                ['nombre_us' => $datos['nombre_us'],
                'apellido1_us' => $datos['apellido_us1'],
                'apellido2_us' => $datos['apellido_us2']
                ]);

        DB::table("tbl_telefono")
        ->where('id_tel','=',$datos_usuario[0]->id_telefono_fk)
        ->update(
            ['contacto1_tel' => $datos['contacto1_tel'],
            'contacto2_tel' => $datos['contacto2_tel']
            ]);
        
        DB::table("tbl_direccion")
        ->where('id_di','=',$datos_usuario[0]->id_direccion1_fk)
        ->update(
            ['nombre_di' => $datos['nombre_di'],
            'numero_di' => $datos['numero_di'],
            'bloque_di' => $datos['bloque_di'],
            'piso_di' => $datos['piso_di'],
            'puerta_di' => $datos['puerta_di'],
            'cp_di' => $datos['cp_di']
            ]);
        

        if ($datos['new_pass_confirm']==null) {
            //No actualizar password
        }elseif($datos['old_pass']!=null && $datos['new_pass']!=null && $datos['new_pass_confirm']!=null){
            $old_pass_hash=hash('sha512', $datos['old_pass']);
            $new_pass_hash=hash('sha512', $datos['new_pass']);
            $new_pass_confirm_hash=hash('sha512', $datos['new_pass_confirm']);

            if ($datos_usuario[0]->pass_us==$old_pass_hash) {
                if ($new_pass_hash==$new_pass_confirm_hash) {
                    
                    DB::beginTransaction();
    
                        $user=DB::table("tbl_usuario")
                            ->where('email_us','=',$request['email_us']) 
                            ->update(['pass_us' => $new_pass_hash]);
                    DB::commit();
                }else{
                    return Redirect::back()->withErrors(['Las nuevas contraseñas no coinciden', 'Misma password']);
                    //return "Las nuevas contraseñas no coinciden";
                }
            }else{
                return Redirect::back()->withErrors(['La contraseña actual no es correcta', 'Error password']);
            }

        }
        return redirect('perfil');
    }

    //Método encargado de hacer el proceso de login
    //$request es la variable encargada de traer todos los datos enviados desde un formulario
    public function loginProc(Request $request)
    {
        if ($request['rul'] == 1) {
            //Validación de datos enviados desde el form, en este caso se verifica en el server
            $request->validate([
                'email_us' => 'required|string|max:70',
                'pass_us' => 'required|string|max:50'
            ]);
            $password_hash=hash('sha512',$request['pass_us']);
            try {
                //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
                $userId = $request->except('_token', '_method');
                $userId_compr=DB::table("tbl_usuario")
                    ->join('tbl_rol', 'tbl_usuario.id_rol_fk', '=', 'tbl_rol.id_ro')
                    ->where('tbl_usuario.email_us','=',$userId['email_us'])
                    ->where('tbl_usuario.pass_us','=',$password_hash)
                    ->get();
                //return $userId_compr;
                //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
                if($userId_compr[0]->rol_ro=='cliente'){
                    //Establecemos sesión
                    $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                    $id_usuario=$usuario[0]->id_us;
                    $rol_usuario=$usuario[0]->id_rol_fk;
                    $request->session()->put('cliente_session', $request->email_us);
                    $request->session()->put('id_user_session', $id_usuario);

                    //Envíamos los registros del usuario que ha iniciado sesión
                    $an_asociado = DB::table('tbl_pacienteanimal_clinica')->where('propietario_fk', '=', $id_usuario)->get();
                    $request->session()->put('animales_asociados', $an_asociado);
                    $request->session()->put('id_rol_session', $rol_usuario);
                    return redirect('/ruleta');
                }else{
                    //No establecemos sesión y lo devolvemos a login
                    return Redirect::back()->withErrors(['Los datos introducidos no son correctos', 'Error password']);
                }
            } catch (\Throwable $e) {
                return $e->getMessage();
            }
        } else{
        //Validación de datos enviados desde el form, en este caso se verifica en el server
        $request->validate([
            'email_us' => 'required|string|max:70',
            'pass_us' => 'required|string|max:50'
        ]);
        $password_hash=hash('sha512',$request['pass_us']);
        //return $password_hash;
        try {
            //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
            $userId = $request->except('_token', '_method');
            $userId_compr=DB::table("tbl_usuario")
                ->join('tbl_rol', 'tbl_usuario.id_rol_fk', '=', 'tbl_rol.id_ro')
                ->where('tbl_usuario.email_us','=',$userId['email_us'])
                ->where('tbl_usuario.pass_us','=',$password_hash)
                ->get();
            //return $userId_compr;
            //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
            if ($userId_compr[0]->rol_ro=='trabajador'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('trabajador_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                $request->session()->put('nombre_session', $usuario[0]->nombre_us);
                return redirect('/');
            }else if($userId_compr[0]->rol_ro=='admin'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('admin_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                $request->session()->put('nombre_session', $usuario[0]->nombre_us);
                return redirect('/cpanel');
            }else if($userId_compr[0]->rol_ro=='cliente'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('cliente_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);

                //Envíamos los registros del usuario que ha iniciado sesión
                $an_asociado = DB::table('tbl_pacienteanimal_clinica')->where('propietario_fk', '=', $id_usuario)->get();
                $request->session()->put('animales_asociados', $an_asociado);
                $request->session()->put('id_rol_session', $rol_usuario);
                $request->session()->put('nombre_session', $usuario[0]->nombre_us);
                return redirect('/');
            }else{
                //No establecemos sesión y lo devolvemos a login
                return "polla";
                return Redirect::back()->withErrors(['Los datos introducidos no son correctos', 'Error password']);
            }
        } catch (\Throwable $e) {
            return Redirect::back()->withErrors(['Los datos introducidos no son correctos', 'Error password']);
        }
    }
    }

    public function regisProc(Request $request){
        //Validación de datos enviados desde el form, en este caso se verifica en el server
        $request->validate([
            'email_us' => 'required|string|max:70',
            'pass_us1' => 'required|string|max:50',
            'pass_us2' => 'required|string|max:50'
        ]);
      
        $datos_usuario=DB::table("tbl_usuario")
            ->where('email_us','=',$request['email_us']) 
            ->get();
        if (isset($datos_usuario[0])) {
            if ($datos_usuario[0]->email_us==$request['email_us']) {
                return Redirect::back()->withErrors(['El mail ya ha sido registrado', 'The Message']);
            }
        }
        


        try {
            //recogemos los datos, teniendo exepciones, como el token que utiliza laravel y el método
            $request->except('_token', '_method');
            //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
            if ($request->input('pass_us1')==$request->input('pass_us2')){
                $pwd = hash( 'sha512', $request['pass_us1'] );
                DB::beginTransaction();
                $id_direccion1 = DB::table('tbl_direccion')->insertGetId(
                    [ 
                    'nombre_di' => $request['nombre_di'],
                    'numero_di'=> $request['numero_di'],
                    'bloque_di'=> $request['bloque_di'],
                    'piso_di'=>$request['piso_di'],
                    'puerta_di'=>$request['puerta_di'],
                    'cp_di'=>$request['cp_di'],
                    ]);

                $id_telefono = DB::table('tbl_telefono')->insertGetId(
                    [   
                    'contacto1_tel' => $request['contacto1_tel'],
                    'contacto2_tel'=> $request['contacto2_tel']
                    ]);
                
                $id_user = DB::table('tbl_usuario')->insertGetId(
                    [ 
                    'nombre_us' => $request['nombre_us'],
                    'apellido1_us'=> $request['apellido1_us'],
                    'apellido2_us'=> $request['apellido2_us'],
                    'dni_us'=>$request['dni_us'],
                    'email_us'=>$request['email_us'],
                    'pass_us'=>$pwd,
                    'id_rol_fk'=>2,
                    'id_telefono_fk'=>$id_telefono,
                    'id_direccion1_fk'=>$id_direccion1
                    ]);
                DB::commit();
                //Establecemos sesión

                $request->session()->put('cliente_session', $request['email_us']);
                $request->session()->put('id_user_session', $id_user);
                $request->session()->put('id_rol_session', 2);
                return redirect('/');
            }else {
                //No establecemos sesión y lo devolvemos a login
                return Redirect::back()->withErrors(['Las contraseñas no coinciden', 'The Message'])->withInput();
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    function regenerarPassword(Request $request) {

        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $password = array(); //remember to declare $password as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $password[] = $alphabet[$n];
        }
        $regen_password=implode($password); //turn the array into a string
        $pass_hasheada=hash('sha512', $regen_password);

        try {
            DB::beginTransaction();
            DB::table('tbl_usuario')
                ->where('email_us','=',$request['mail_regenerar']) 
                ->update(['pass_us' => $pass_hasheada]);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }

        $mail=$request['mail_regenerar'];
        $datas=[$regen_password];
        //Envío de mail
        $sub = "Cambio de contraseña";
        $enviar = new Mailtocustomers($datas,1);
        $enviar->sub = $sub;
        Mail::to($mail)->send($enviar);

        return redirect('/login');
    }
}
