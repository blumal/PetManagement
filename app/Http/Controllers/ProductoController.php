<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function mostrarProductoCrud(){
        $listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_foto on tbl_foto.id_f=tbl_articulo_tienda.id_foto_fk inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk');
        $dbMarcas=DB::select('select * from tbl_marca;');
        $dbTipos=DB::select('select * from tbl_tipo_articulo;');
        return view('admincrud', compact('listaProducto','dbMarcas','dbTipos'));
    }

    public function show(Request $request){
        $listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_foto on tbl_foto.id_f=tbl_articulo_tienda.id_foto_fk inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk');
        return response()->json($listaProducto);
    }
    /*Mostrar productos prueba*/
    public function mostrarProducto(Request $request){
        $array3 = $request->session()->get('carrito');
        $listaProducto = DB::table('tbl_articulo_tienda')->select('*')->get();
        return view('vistaprueba', compact('listaProducto'),compact('array3'));
    }

    /*Âñadir al carro*/
    public function CartAdd(Request $request){
        //Se recupera el id del producto seleccionado y la variable de 
        //$producto = Producto::find($request->producto_id);
        $producto = DB::select('select * from `tbl_articulo_tienda` where `tbl_articulo_tienda`.`id_art` =?',[$request->producto_id]);
        $comp = $request->session()->get('carrito');
        //se comprueba si la variable de sesion está definida
        if (isset($comp)){
            //si la variable de sesion no es null, se recupera esta misma y se guarda en una variable
            $array1 = $request->session()->get('carrito');
            //se guarda el id del producto seleccionado en un array
            $array2[] = $producto[0]->id_art;
            //al ser la variable de sesion un array, y el id del producto seleccionado también esta guardado en un array, se usa arraymerge para obtener como resultado un array de sesion con los diferentes ids
            $request->session()->put('carrito',array_merge($array1,$array2));
        } else {
            //si la variable de sesion esta vacia, es decir, aun no se ha añadido ningún producto al carrito se guardará como array el id del producto
            $array1[] = $producto[0]->id_art;
            $request->session()->put('carrito', $array1);
        }
        //$array3=$request->session()->get('carrito');
        //return view('carritoview', compact('array3'));
        //return $array3;
        return redirect('vistaprueba');
    }
    /*Checkout carrito*/
    public function CartCheckout(Request $request){
        //se recupera la variable de sesion y se guarda en una variable para devolverla a la vista
        $array3 = $request->session()->get('carrito');

        return view('carritoview', compact('array3'));
    }

    /*Vaciar carrito*/
    public function CartClearOut(Request $request){
        //para vaciar el carrito se usa la función forget para vaciar la variable de sesion sin destruir la misma
        $request->session()->forget('carrito');
        return redirect('vistaprueba');
    }

    public function eliminar($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            $id2=DB::select('select id_direccion_fk from tbl_lugar where id_lu =?',[$id]);
            $id3=DB::select('select id_foto_fk from tbl_lugar where id_lu =?',[$id]);
            $id4=DB::select('select id_icono_fk from tbl_lugar where id_lu =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_lugar')->where('id_lu','=',$id)->delete();
            DB::table('tbl_direccion')->where('id_di','=',$id2[0]->id_direccion_fk)->delete();
            DB::table('tbl_foto')->where('id_fo','=',$id3[0]->id_foto_fk)->delete();
            DB::table('tbl_icono')->where('id_ic','=',$id4[0]->id_icono_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function crear(Request $request){

        try{
            DB::insert('insert into tbl_usuario (nombre_us,apellido1_us,apellido2_us,email_us,pass_us,id_rol_fk) values (?,?,?,?,?,?)',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),('2')]);  
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function update(Request $request) {
        try {
            DB::update('update tbl_usuario set nombre_us=?, apellido1_us=?, apellido2_us=?, email_us=?, pass_us =? where id_us=?',[$request->input('nombre_us'),$request->input('apellido1_us'),$request->input('apellido2_us'),$request->input('email_us'),$request->input('pass_us'),$request->input('id_us')]);
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
