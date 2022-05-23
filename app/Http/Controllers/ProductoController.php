<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductoCrear;
use Illuminate\Support\Facades\Redirect;

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
        $productos=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda`;");
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
            $sql= "SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_marca.id_ma like '%%' And";
            $length = count($datos['marcas']);
            for ($i = 0; $i < $length; $i++) {
                if ($i==$length-1) {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i];
                }else {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i]." or ";
                } 
            }
            $marcas=DB::select($sql);
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['nombre']."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$datos['nombre']."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
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
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['nombre']."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$datos['nombre']."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
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
            $sql= "SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_marca.id_ma like '%%' And";
            $length = count($datos['marcas']);
            for ($i = 0; $i < $length; $i++) {
                if ($i==$length-1) {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i];
                }else {
                    $sql= $sql." tbl_marca.id_ma=".$datos['marcas'][$i]." or ";
                } 
            }
            $marcas=DB::select($sql);
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['categoria']."%' ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
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
        $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['categoria']."%' ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            return response()->json($tipo);
            
       }

    }

    public function producto($id) {
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$id]);
        $fotos=DB::select("SELECT tbl_foto.foto_f FROM `tbl_foto` WHERE tbl_foto.articulo_tienda_fk=?",[$id]);
        return view('producto', compact('producto', 'fotos'));
    }

    public function marcaProducto(Request $request) {
        $datos = $request->except('_token');
        $marca=DB::select("SELECT tbl_marca.marca_ma FROM `tbl_marca` WHERE tbl_marca.id_ma=?",[$datos['marca']]);
        return response()->json($marca);
    }

    //sesiones carrito
    public function addToCart($id)
    {
        $product = DB::select("SELECT tbl_articulo_tienda.id_art,tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art,tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art,tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art,tbl_articulo_tienda.id_marca_fk,tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` WHERE tbl_articulo_tienda.id_art=?",[$id]);
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
                        "precio" => $product[0]->precio_art,
                        "foto" => $product[0]->foto_art
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
            "precio" => $product[0]->precio_art,
            "foto" => $product[0]->foto_art
        ];
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }
    public function addToCartProducto($id, $cantidad)
    {
        $path="producto/".$id;
        $product = DB::select("SELECT tbl_articulo_tienda.id_art,tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art,tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art,tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art,tbl_articulo_tienda.id_marca_fk,tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` WHERE tbl_articulo_tienda.id_art=?",[$id]);
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
                        "precio" => $product[0]->precio_art,
                        "foto" => $product[0]->foto_art
                    ]
            ];
            session()->put('cart', $cart);
            return Redirect::to($path);
        }
        //
        if(isset($cart[$id])) {
            $cantidad=$cantidad+$cart[$id]['cantidad'];
            $cart[$id]['cantidad']=$cantidad;
            session()->put('cart', $cart);
            return Redirect::to($path);
        }
        //
        $cart[$id] = [
            "nombre" => $product[0]->nombre_art,
            "cantidad" => $cantidad,
            "precio" => $product[0]->precio_art,
            "foto" => $product[0]->foto_art
        ];
        session()->put('cart', $cart);
        return Redirect::to($path);
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function compra(Request $request){
        $request->session()->forget('cart');
        return redirect('comprafinalizada');
    }
    
    public function mostrarCompra(){
         return view('comprafinalizada');
     } 
    public function mostrarProductoCrud(){
        //$listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_foto on tbl_foto.id_f=tbl_articulo_tienda.id_foto_fk inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk');
        $listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk ');
        $dbMarcas=DB::select('select * from tbl_marca;');
        $dbTipos=DB::select('select * from tbl_tipo_articulo;');
        $dbCategorias=DB::select('select * from tbl_categoria_articulo;');
        return view('admincrud', compact('listaProducto','dbMarcas','dbTipos','dbCategorias'));
    }

   public function show(Request $request){
        $listaProducto=DB::select('select * from tbl_articulo_tienda inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk where nombre_art like ?',['%'.$request->input('nombre_art').'%']);
        return response()->json($listaProducto);
    }
   
    /*Mostrar productos prueba*/
    public function mostrarProducto(Request $request){
        $array3 = $request->session()->get('carrito');
        $listaProducto = DB::table('tbl_articulo_tienda')->select('*')->get();
        return view('vistaprueba', compact('listaProducto'),compact('array3'));
    }

    public function eliminar($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            //$id3=DB::select('select id_foto_fk from tbl_articulo_tienda where id_art =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_categoria_articulo')->where('articulo_fk','=',$id)->delete();
            DB::table('tbl_articulo_tienda')->where('id_art','=',$id)->delete();
            //DB::table('tbl_foto')->where('id_f','=',$id3[0]->id_foto_fk)->delete();
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
            //DB::insert('insert into tbl_foto (foto_f) values(?)',[$ffoto]);
            //$id4 = DB::select('select id_f from tbl_foto where foto_f =?',[$ffoto]);
            DB::insert('insert into tbl_articulo_tienda (nombre_art,descripcion_art,precio_art,codigobarras_art,foto_art,id_marca_fk,id_tipo_articulo_fk) values (?,?,?,?,?,?,?)',[$request->input('nombre_art'),$request->input('descripcion_art'),$request->input('precio_art'),$request->input('codigobarras_art'),($ffoto),$request->input('id_marca_fk'),$request->input('id_tipo_articulo_fk')]);
            // $id0 = DB::select('select id_art from tbl_articulo_tienda order by id_art desc limit 1');
            // DB::insert('insert into tbl_stock (id_articulo_fk,cantidad_st) values (?,?)',[$id0[0]->id_art,$request->input('cantidad_st')]);
            return response()->json(array('resultado'=> 'OK'));
        }catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function update(Request $request) {
        try {
            //$id6 = DB::select('select id_foto_fk from tbl_articulo_tienda where id_art=?',[$request->input('id_art_e')]);
            $datos = $request->except('_token');
            if ($request->hasFile('foto_e')) {
                $foto = DB::select('select foto_art from tbl_articulo_tienda where id_art =?',[$request->input('id_art_e')]);
                if ($foto[0]->foto_art != null) {
                    Storage::delete('public/'.$foto[0]->foto_art);
                }
                $ffoto2 = $request->file('foto_e')->store('uploads','public');
            }else{
                $foto = DB::select('select foto_art from tbl_articulo_tienda where id_art =?',[$request->input('id_art_e')]);
                $ffoto2 = $foto[0]->foto_art;
            }
            //DB::update('update tbl_foto set foto_f=? where id_f=?',[$ffoto2,$id6[0]->id_foto_fk]);
            //$id4 = DB::select('select id_f from tbl_foto where foto_f =?',[$ffoto2]);
            DB::update('update tbl_articulo_tienda set nombre_art=?, descripcion_art=?, precio_art=?, codigobarras_art=?, foto_art=?, id_marca_fk =?, id_tipo_articulo_fk=? where id_art=?',[$request->input('nombre_art_e'),$request->input('descripcion_art_e'),$request->input('precio_art_e'),$request->input('codigobarras_art_e'),($ffoto2),$request->input('id_marca_fk_e'),$request->input('id_tipo_articulo_fk_e'),$request->input('id_art_e')]);
            //DB::update('update tbl_stock set cantidad_st=? where id_articulo_fk=?',[$request->input('cantidad_st_e'),$request->input('id_art_e')]);
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function sub($id) {
        $listaCategoria=DB::select('select * from tbl_categoria_articulo where articulo_fk = ?',[$id]);
        return response()->json($listaCategoria);
    }

    public function eliminarsub($idsub){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            //$id3=DB::select('select id_foto_fk from tbl_articulo_tienda where id_art =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::table('tbl_categoria_articulo')->where('id_cat','=',$idsub)->delete();
            //DB::table('tbl_foto')->where('id_f','=',$id3[0]->id_foto_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function crearsub($id){
        //return $id2[0]->id_direccion_fk;
        try {
            DB::beginTransaction();
            //$id3=DB::select('select id_foto_fk from tbl_articulo_tienda where id_art =?',[$id]);
            // return $id2[0]->id_direccion_fk;
            DB::insert('insert into tbl_categoria_articulo (texto_cat,precio_cat,articulo_fk,cantidad) values (?,?,?,?)',[NULL,NULL,$id,NULL]);
            //DB::table('tbl_foto')->where('id_f','=',$id3[0]->id_foto_fk)->delete();
            DB::commit();
            return response()->json(array('resultado'=> 'OK'));
        }catch(\Exception $th){
            DB::rollBack();
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    public function editarsub(Request $request) {
        try {
            DB::update('update tbl_categoria_articulo set texto_cat=?, precio_cat=?, cantidad=? where id_cat=?',[$request->input('texto_cat'),$request->input('precio_cat'),$request->input('cantidad'),$request->input('id_cat')]);
            //return response()->json(array('resultado'=> 'NOKl: '.$request->input('id_cat')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }

    /*Tarjeta de credito*/
    public function stripe()
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Test payment."
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
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
