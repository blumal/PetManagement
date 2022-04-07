<?php

namespace App\Http\Controllers;

use App\Models\Citas;
use Illuminate\Http\Request;
//Necesario para cualquier query
use Illuminate\Support\Facades\DB;

class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /**/
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
            //Hacemos la consulta con la DB, la cual contará nuestros resultados
            $userId_compr = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $userId['pass_us'])->count();
            //En caso de que nuestra consulta de como resultado 1, gracias a count haz...
            if ($userId_compr == 1){
                //Establecemos sesión
                $usuario = DB::table('tbl_usuario')->where('email_us', '=', $userId['email_us'])->where('pass_us', '=', $userId['pass_us'])->get();
                $id_usuario=$usuario[0]->id_us;
                $request->session()->put('email_session', $request->email_us);
                $request->session()->put('id_user_session', $id_usuario);
                return redirect('/citas');
            }else{
                //No establecemos sesión y lo devolvemos a login
                return redirect('/login');
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }

    public function Citas(){
        return view('clinica/vistas/citas');
    }
    
    public function showcitas(){
        $today = now()->format('Y-m-d');
        $citas = DB::select("SELECT fecha_vi, hora_vi FROM tbl_visita WHERE fecha_vi >= '$today'");
        return response()->json($citas);
    }
}
