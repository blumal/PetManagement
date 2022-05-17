<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

class UsuarioController extends Controller
{
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
        return view('login/editarPerfil',compact('profile'));
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
            if ($userId_compr[0]->rol_ro=='trabajador'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('trabajador_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
                return redirect('/');
            }else if($userId_compr[0]->rol_ro=='admin'){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $password_hash)->get();
                $id_usuario=$usuario[0]->id_us;
                $rol_usuario=$usuario[0]->id_rol_fk;
                $request->session()->put('admin_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                $request->session()->put('id_rol_session', $rol_usuario);
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
                return redirect('/');
            }else{
                //No establecemos sesión y lo devolvemos a login
                return redirect('/login');
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function regisProc(Request $request){
        //Validación de datos enviados desde el form, en este caso se verifica en el server
        $request->validate([
            'email_us' => 'required|string|max:70',
            'pass_us1' => 'required|string|max:50',
            'pass_us2' => 'required|string|max:50'
        ]);

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
                return redirect('/registro');
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
