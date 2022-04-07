<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function tienda()
    {
        return view('tienda');
    }

    public function carrito()
    {
        return view('carrito');
    }


    public function marcas() {
        $marcas=DB::select('SELECT tbl_marca.id_ma, tbl_marca.marca_ma FROM `tbl_marca`;');
        return response()->json($marcas);
    }

    public function tiposPrincipales() {
        $categorias=DB::select("SELECT tbl_tipo_articulo.id_ta, tbl_tipo_articulo.tipo_articulo_ta FROM `tbl_tipo_articulo` where tbl_tipo_articulo.tipo_articulo_ta= 'Comida para perro' or tbl_tipo_articulo.tipo_articulo_ta= 'Animales de Granja' or tbl_tipo_articulo.tipo_articulo_ta= 'Comida para gato' or tbl_tipo_articulo.tipo_articulo_ta= 'Repelentes para perro' or tbl_tipo_articulo.tipo_articulo_ta= 'Accesorios hogar' or tbl_tipo_articulo.tipo_articulo_ta= 'Juguetes' or tbl_tipo_articulo.tipo_articulo_ta= 'Roedores' or tbl_tipo_articulo.tipo_articulo_ta= 'Peces';");
        return response()->json($categorias);
    }

    public function productos() {
        $productos=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda`;");
        return response()->json($productos);
    }

    public function filtroSearchBar(Request $request) {
        $datos = $request->except('_token');
        //$marcas=array();
        if (isset($datos['marcas'])) {
            $marcas=json_encode($datos['marcas']);
        }
        //$marcas = explode(',', $marcas);
        if (isset($marcas)) {
            $sql= "SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_marca.id_ma like '%%' And";
            $length = count($datos['marcas']);
            for ($i = 0; $i < $length; $i++) {
                if ($i==$length-1) {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i];
                }else {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i]." or ";
                } 
            }
            $marcas=DB::select($sql);
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['nombre']."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$datos['nombre']."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            $productos=array();
            foreach ($tipo as $productoT) {
                foreach ($marcas as $productoM) {
                    if ($productoT == $productoM) {
                        array_push($productos,$productoT);
                    }
                }
            }
        return response()->json($productos);
            
       }else {
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['nombre']."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$datos['nombre']."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            return response()->json($tipo);
            
       }
        
    }

    public function filtroCatPrinc(Request $request) {
        $datos = $request->except('_token');
        //$marcas=array();
        if (isset($datos['marcas'])) {
            $marcas=json_encode($datos['marcas']);
        }
        //$marcas = explode(',', $marcas);
        if (isset($marcas)) {
            $sql= "SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_marca.id_ma like '%%' And";
            $length = count($datos['marcas']);
            for ($i = 0; $i < $length; $i++) {
                if ($i==$length-1) {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i];
                }else {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i]." or ";
                } 
            }
            $marcas=DB::select($sql);
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['categoria']."%' ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            $productos=array();
            foreach ($tipo as $productoT) {
                foreach ($marcas as $productoM) {
                    if ($productoT == $productoM) {
                        array_push($productos,$productoT);
                    }
                }
            }
        return response()->json($productos);
            
       }else {
        $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['categoria']."%' ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            return response()->json($tipo);
            
       }

    }

    public function producto($id) {
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$id]);
        return view('producto', compact('producto'));
    }

    public function marcaProducto(Request $request) {
        $datos = $request->except('_token');
        $marca=DB::select("SELECT tbl_marca.marca_ma FROM `tbl_marca` WHERE tbl_marca.id_ma=?",[$datos['marca']]);
        return response()->json($marca);
    }

    //sesiones carrito
    public function addToCart($id)
    {
        $product = DB::select("SELECT tbl_articulo_tienda.id_art,tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.precio_art,tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_foto_fk,tbl_articulo_tienda.id_marca_fk,tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` WHERE tbl_articulo_tienda.id_art=?",[$id]);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            $cart = [
                    $id => [
                        "nombre" => $product[0]->nombre_art,
                        "cantidad" => 1,
                        "precio" => $product[0]->precio_art
                    ]
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "nombre" => $product[0]->nombre_art,
            "cantidad" => 1,
            "precio" => $product[0]->precio_art
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function addToCartProducto(Request $request)
    {
        $datos = $request->except('_token');
        $id=$datos['id'];
        $cantidad=$datos['cantidad'];
        $product = DB::select("SELECT tbl_articulo_tienda.id_art,tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.precio_art,tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_foto_fk,tbl_articulo_tienda.id_marca_fk,tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` WHERE tbl_articulo_tienda.id_art=?",[$id]);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        //
        if(!$cart) {
            $cart = [
                    $id => [
                        "nombre" => $product[0]->nombre_art,
                        "cantidad" => $cantidad,
                        "precio" => $product[0]->precio_art
                    ]
            ];
            session()->put('cart', $cart);
            return response()->json(array('resultado'=> 'OK'));
        }
        //
        if(isset($cart[$id])) {
            $cart[$id]['cantidad']==$cantidad;
            session()->put('cart', $cart);
            return response()->json(array('resultado'=> 'OK'));
        }
        //
        $cart[$id] = [
            "nombre" => $product[0]->nombre_art,
            "cantidad" => $cantidad,
            "precio" => $product[0]->precio_art
        ];
        session()->put('cart', $cart);
        return response()->json(array('resultado'=> 'OK'));
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $cart = session()->get('cart');
            $cart[$request->id]["cantidad"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    
    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }

    /*Dinero*/
    public function enviarDinero($total){
        //$resultado = $precio.','.$id;
        //return $resultado;

        //Aqui generamos la clase ApiContext que es la que hace la conexión
        $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            config('services.paypal.client_id'),     // ClientID
            config('services.paypal.client_secret')      // ClientSecret
        ));

        //Generamos otra clase Payer
        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');

        //Generamos la tercera clase (Amount) que dice la cantidad a pagar
        $amount = new \PayPal\Api\Amount();

        //precio a pagar
        $amount->setTotal($total);
        $amount->setCurrency('EUR');

        //Generamos otra clase donde le pasamos el precio y la moneda
        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);

        //le envioa la pagina informacion del id
        //si se cancela lo llevo a la pagina que quiero
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls->setReturnUrl(url("comprado"))->setCancelUrl(url("/"));

        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($apiContext);
            //me redirige a la pagina de compra
            return redirect()->away( $payment->getApprovalLink());

        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }

    }

    public function compra(Request $request){
        return "La compra se ha completado con exito";
    }
    
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
        $listaProducto=DB::select('select * from tbl_articulo_tienda inner join tbl_foto on tbl_foto.id_f=tbl_articulo_tienda.id_foto_fk inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk where nombre_art like ?',['%'.$request->input('nombre_art').'%']);
        return response()->json($listaProducto);
    }
    /*Mostrar productos prueba*/
    public function mostrarProducto(Request $request){
        $array3 = $request->session()->get('carrito');
        $listaProducto = DB::table('tbl_articulo_tienda')->select('*')->get();
        return view('vistaprueba', compact('listaProducto'),compact('array3'));
    }

    
    // /*Âñadir al carro*/
    // public function CartAdd(Request $request){
    //     //Se recupera el id del producto seleccionado y la variable de 
    //     //$producto = Producto::find($request->producto_id);
    //     $producto = DB::select('select * from `tbl_articulo_tienda` where `tbl_articulo_tienda`.`id_art` =?',[$request->producto_id]);
    //     $comp = $request->session()->get('carrito');
    //     //se comprueba si la variable de sesion está definida
    //     if (isset($comp)){
    //         //si la variable de sesion no es null, se recupera esta misma y se guarda en una variable
    //         $array1 = $request->session()->get('carrito');
    //         //se guarda el id del producto seleccionado en un array
    //         $array2[] = $producto[0]->id_art;
    //         //al ser la variable de sesion un array, y el id del producto seleccionado también esta guardado en un array, se usa arraymerge para obtener como resultado un array de sesion con los diferentes ids
    //         $request->session()->put('carrito',array_merge($array1,$array2));
    //     } else {
    //         //si la variable de sesion esta vacia, es decir, aun no se ha añadido ningún producto al carrito se guardará como array el id del producto
    //         $array1[] = $producto[0]->id_art;
    //         $request->session()->put('carrito', $array1);
    //     }
    //     //$array3=$request->session()->get('carrito');
    //     //return view('carritoview', compact('array3'));
    //     //return $array3;
    //     return redirect('vistaprueba');
    // }
    // /*Checkout carrito*/
    // public function CartCheckout(Request $request){
    //     //se recupera la variable de sesion y se guarda en una variable para devolverla a la vista
    //     $array3 = $request->session()->get('carrito');

    //     return view('carritoview', compact('array3'));
    // }

    // /*Vaciar carrito*/
    // public function CartClearOut(Request $request){
    //     //para vaciar el carrito se usa la función forget para vaciar la variable de sesion sin destruir la misma
    //     $request->session()->forget('carrito');
    //     return redirect('vistaprueba');
    // }
    

    public function eliminar($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            $id3=DB::select('select id_foto_fk from tbl_articulo_tienda where id_art =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_articulo_tienda')->where('id_art','=',$id)->delete();
            DB::table('tbl_foto')->where('id_f','=',$id3[0]->id_foto_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function crear(Request $request){

        try{
            $datos = $request->except('_token');
            if($request->hasFile('foto')){
                $ffoto = $request->file('foto')->store('uploads','public');
            }else{
                $datos['foto'] = NULL;
            }
            DB::insert('insert into tbl_foto (foto_f) values(?)',[$ffoto]);
            $id4 = DB::select('select id_f from tbl_foto where foto_f =?',[$ffoto]);
            DB::insert('insert into tbl_articulo_tienda (nombre_art,precio_art,codigobarras_art,id_foto_fk,id_marca_fk,id_tipo_articulo_fk) values (?,?,?,?,?,?)',[$request->input('nombre_art'),$request->input('precio_art'),$request->input('codigobarras_art'),($id4[0]->id_f),$request->input('id_marca_fk'),$request->input('id_tipo_articulo_fk')]);  
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function update(Request $request) {
        try {
            $id6 = DB::select('select id_foto_fk from tbl_articulo_tienda where id_art=?',[$request->input('id_art_e')]);
            $datos = $request->except('_token');
            if ($request->hasFile('foto_e')) {
                $foto = DB::select('select foto_f from tbl_foto where id_f =?',[$id6[0]->id_foto_fk]);
                if ($foto[0]->foto_f != null) {
                    Storage::delete('public/'.$foto[0]->foto_f);
                }
                $ffoto2 = $request->file('foto_e')->store('uploads','public');
            }else{
                $foto = DB::select('select foto_f from tbl_foto where id_f =?',[$id6[0]->id_foto_fk]);
                $ffoto2 = $foto[0]->foto_f;
            }
            DB::update('update tbl_foto set foto_f=? where id_f=?',[$ffoto2,$id6[0]->id_foto_fk]);
            $id4 = DB::select('select id_f from tbl_foto where foto_f =?',[$ffoto2]);
            DB::update('update tbl_articulo_tienda set nombre_art=?, precio_art=?, codigobarras_art=?, id_foto_fk=?, id_marca_fk =?, id_tipo_articulo_fk=? where id_art=?',[$request->input('nombre_art_e'),$request->input('precio_art_e'),$request->input('codigobarras_art_e'),($id4[0]->id_f),$request->input('id_marca_fk_e'),$request->input('id_tipo_articulo_fk_e'),$request->input('id_art_e')]);
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
