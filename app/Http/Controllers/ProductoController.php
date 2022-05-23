<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductoCrear;
use Illuminate\Support\Facades\Redirect;
use App\Mail\Mailtocustomers;
use Illuminate\Support\Facades\Mail;

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
        $productos=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk, tbl_articulo_tienda.tipo_categoria_art FROM `tbl_articulo_tienda`;");
        return response()->json($productos);
    }

    public function getProduct(Request $request) {
        $datos = $request->except('_token');
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma, tbl_articulo_tienda.tipo_categoria_art, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$datos['id']]);
        $categorias=DB::select("SELECT tbl_categoria_articulo.id_cat, tbl_categoria_articulo.texto_cat, tbl_categoria_articulo.precio_cat, tbl_categoria_articulo.articulo_fk, tbl_categoria_articulo.cantidad FROM `tbl_categoria_articulo` WHERE articulo_fk=? AND cantidad>0 ORDER BY precio_cat ASC",[$datos['id']]);
        $campos=array();
        array_push($campos,$producto);
        array_push($campos,$categorias);
        return response()->json($campos);
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
            if (isset($datos['palabras'])) {
                $palabras=json_encode($datos['palabras']);
            }
            if (isset($palabras)) {
                $array=array();
           foreach ($datos['palabras'] as $palabra) {
            $palabraql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$palabra."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$palabra."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
               $Arraypalabra=DB::select($palabraql);
               foreach ($Arraypalabra as $palabra) {
                   array_push($array,$palabra);
               }
           }
           $tipo=array();
           $arraycount=count($array);
           for ($i=0; $i < $arraycount; $i++) { 
               for ($j=0; $j < $arraycount; $j++) { 
                   if ($i!=$j) {
                    if ($array[$i]==$array[$j] && !in_array($array[$j], $tipo)) {
                        array_push($tipo,$array[$i]);
                    }
                   }
                   
               }
           }
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
                return response()->json($marcas);
            }
            
            
            
            
       }else {
          $array=array();
           foreach ($datos['palabras'] as $palabra) {
            $palabraql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$palabra."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$palabra."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
               $Arraypalabra=DB::select($palabraql);
               foreach ($Arraypalabra as $palabra) {
                   array_push($array,$palabra);
               }
           }
           $tipo=array();
           $arraycount=count($array);
           for ($i=0; $i < $arraycount; $i++) { 
               for ($j=0; $j < $arraycount; $j++) { 
                   if ($i!=$j) {
                    if ($array[$i]==$array[$j] && !in_array($array[$j], $tipo)) {
                        array_push($tipo,$array[$i]);
                    }
                   }
                   
               }
           }
           return response()->json($tipo);
           //Antiguo
           /*
            $tiposql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$datos['nombre']."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$datos['nombre']."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
            $tipo=DB::select($tiposql);
            return response()->json($tipo);
            */
            //Antiguo
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
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma, tbl_articulo_tienda.tipo_categoria_art, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$id]);
        $fotos=DB::select("SELECT tbl_foto.foto_f FROM `tbl_foto` WHERE tbl_foto.articulo_tienda_fk=?",[$id]);
        $categorias=DB::select("SELECT tbl_categoria_articulo.id_cat, tbl_categoria_articulo.texto_cat, tbl_categoria_articulo.precio_cat, tbl_categoria_articulo.articulo_fk, tbl_categoria_articulo.cantidad FROM `tbl_categoria_articulo` WHERE articulo_fk=? AND cantidad>0 ORDER BY precio_cat ASC",[$id]);
        return view('producto', compact('producto', 'fotos', 'categorias'));
    }

    public function productosSimilares(Request $request) {
        $datos = $request->except('_token');
        $productosSimilares=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.foto_art FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.tipo_categoria_art=tbl_tipo_articulo.id_ta WHERE tbl_articulo_tienda.id_tipo_articulo_fk=?",[$datos['id']]);
        return response()->json($productosSimilares);
    }

    public function marcaProducto(Request $request) {
        $datos = $request->except('_token');
        $marca=DB::select("SELECT tbl_marca.marca_ma FROM `tbl_marca` WHERE tbl_marca.id_ma=?",[$datos['marca']]);
        return response()->json($marca);
    }

    public function productosOpiniones(Request $request) {
        $datos = $request->except('_token');
        $opiniones=DB::select("SELECT tbl_opinion_articulo.id_op, tbl_opinion_articulo.texto_op, tbl_opinion_articulo.valoracion_op, tbl_usuario.nombre_us, tbl_usuario.apellido1_us, tbl_articulo_tienda.nombre_art FROM tbl_articulo_tienda INNER JOIN tbl_opinion_articulo ON tbl_articulo_tienda.id_art=tbl_opinion_articulo.articulo_fk INNER JOIN tbl_usuario ON tbl_opinion_articulo.usuario_fk=tbl_usuario.id_us WHERE tbl_articulo_tienda.id_art=? ORDER BY id_op DESC",[$datos['id']]);
        return response()->json($opiniones);
    }
    public function productosOpinionesTodas(Request $request) {
        $datos = $request->except('_token');
        $opiniones=DB::select("SELECT tbl_opinion_articulo.id_op, tbl_opinion_articulo.texto_op, tbl_opinion_articulo.valoracion_op, tbl_usuario.nombre_us, tbl_usuario.apellido1_us, tbl_articulo_tienda.nombre_art FROM tbl_articulo_tienda INNER JOIN tbl_opinion_articulo ON tbl_articulo_tienda.id_art=tbl_opinion_articulo.articulo_fk INNER JOIN tbl_usuario ON tbl_opinion_articulo.usuario_fk=tbl_usuario.id_us WHERE tbl_articulo_tienda.id_art=? ORDER BY id_op DESC",[$datos['id']]);
        return response()->json($opiniones);
    }

    public function limiteCarrito(Request $request) {
        $datos = $request->except('_token');
        $cantidad=DB::select("SELECT tbl_categoria_articulo.cantidad FROM `tbl_categoria_articulo` WHERE tbl_categoria_articulo.id_cat=?",[$datos['subcategoria']]);
        return response()->json($cantidad);
    }

    public function insertarOpinion(Request $request) {
        $datos = $request->except('_token');
        DB::select("INSERT INTO `tbl_opinion_articulo` (`id_op`, `texto_op`, `valoracion_op`, `usuario_fk`, `articulo_fk`) VALUES (NULL, ?, ?, ?, ?)",[$datos['comentario'],$datos['valoracion'],$datos['usuario'],$datos['producto']]);
        return response()->json(array('resultado'=> 'OK'));
    }

    //sesiones carrito
    /*
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
                        "id" => $product[0]->id_art,
                        "nombre" => $product[0]->nombre_art,
                        "cantidad" => 1,
                        "precio" => $product[0]->precio_art,
                        "foto" => $product[0]->foto_art
                    ]
            ];
            session()->put('cart', $cart);
            return response()->json($cart);
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$id])) {
            $cart[$id]['cantidad']++;
            session()->put('cart', $cart);
            return response()->json($cart);
        }
        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "id" => $product[0]->id_art,
            "nombre" => $product[0]->nombre_art,
            "cantidad" => 1,
            "precio" => $product[0]->precio_art,
            "foto" => $product[0]->foto_art
        ];
        session()->put('cart', $cart);
        return response()->json($cart);
    }
    */
    public function addToCartProducto($id, $cantidad, $subcategoria)
    {
        $path="producto/".$id;
        $product = DB::select("SELECT tbl_articulo_tienda.id_art,tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art,tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art,tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art,tbl_articulo_tienda.id_marca_fk,tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` WHERE tbl_articulo_tienda.id_art=?",[$id]);
        $productPrice=DB::select("SELECT tbl_Categoria_Articulo.id_cat, tbl_Categoria_Articulo.texto_cat, tbl_Categoria_Articulo.precio_cat FROM `tbl_categoria_articulo` WHERE id_cat=?",[$subcategoria]);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        //
        if(!$cart) {
            $cart = [

                    $subcategoria => [

                        "id" => $product[0]->id_art,
                        "nombre" => $product[0]->nombre_art,
                        "subcategoria_texto" => $productPrice[0]->texto_cat,
                        "cantidad" => $cantidad,
                        "precio" => $productPrice[0]->precio_cat,
                        "foto" => $product[0]->foto_art
                    ]
            ];
            session()->put('cart', $cart);
            return response()->json($cart);
        }
        //
        if(isset($cart[$subcategoria])) {
            $cantidad=$cantidad+$cart[$subcategoria]['cantidad'];
            $cart[$subcategoria]['cantidad']=$cantidad;
            session()->put('cart', $cart);
            return response()->json($cart);
        }
        //
        $cart[$subcategoria] = [
            "nombre" => $product[0]->nombre_art,
            "subcategoria_texto" => $productPrice[0]->texto_cat,
            "cantidad" => $cantidad,
            "precio" => $productPrice[0]->precio_cat,
            "foto" => $product[0]->foto_art
        ];
        session()->put('cart', $cart);
        return response()->json($cart);
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

    public function cogerSesion(Request $request) {
        //CAMBIAR SESION CART POR LA DE USER
        $user = session()->get('id_user_session');
        return response()->json($user);
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
        date_default_timezone_set('EUROPE/Madrid');

        $total_factura=0;
        $id_promocion_fk=1;
        $id_user_session=$request->session()->get('id_user_session');
        $date = date("Y-m-d");
        $time = date("H:i:s");
        $localtime = date('H:i:s', strtotime($time));
        

        $carrito=$request->session()->get('cart');
        foreach ($carrito as $item_Compra) {
            $total_factura= $total_factura + ($item_Compra['cantidad']*$item_Compra['precio']);
        }
       

        DB::beginTransaction();
        $id_factura_tienda = DB::table('tbl_factura_tienda')->insertGetId(
            [ 'fecha_ft' => $date,
            'hora_ft'=> $localtime,
            'total_ft'=>$total_factura,
            'id_promocion_fk'=>$id_promocion_fk,
            'id_usuario_fk'=>$id_user_session ]);
        foreach ($carrito as $item_compra) {
            DB::insert('insert into tbl_detallefactura_tienda (id_articulo_fk,cantidad_dft,id_factura_tienda_fk) values (?,?,?)',
            [$item_compra['id'],$item_compra['cantidad'],$id_factura_tienda]);
        }
        DB::commit();

        //COMPROBACION NUMERO DE COMPRAS PARA RULETA

        $premio=0;
        DB::beginTransaction();
        $numero_compras = DB::table('tbl_factura_tienda')->where('id_usuario_fk', '=', $id_user_session)
            ->count();
        $ha_tenido_promo = DB::table('tbl_clientes_promo')->where('fk_id_us', '=', $id_user_session)
            ->count();
        if (($numero_compras % 5) == 0) {
            if ($ha_tenido_promo>0) {
                DB::table('tbl_clientes_promo')
                    ->where('fk_id_us', $id_user_session)  // find your user by their email
                    ->limit(1)  // optional - to ensure only one record is updated.
                    ->update( [ 'comprobar_cli_pro' => 0] );
                $premio=1;
            }else{
                DB::insert('insert into tbl_clientes_promo (comprobar_cli_pro, fk_id_us) values (?, ?)',
                [0, $id_user_session]);
                $premio=1;
            }
        }
        DB::commit();

        //Envío de mail
        $sub = "Confirmación de compra";
        $datas=[$localtime,$date,$total_factura,$id_factura_tienda,$premio];
        $enviar = new Mailtocustomers($datas,1);
        //,$total_factura,$localtime,$date
        $enviar->sub = $sub;
        Mail::to(session('cliente_session'))->send($enviar);
        //Mail::to("gomezmonterroso14@gmail.com")->send($enviar);
        /*
        for ($i=1; $i < (count($carrito)+1); $i++) {
            DB::insert('insert into tbl_detallefactura_tienda (id_articulo_fk,cantidad_dft,id_factura_tienda_fk) values (?,?,?)',
            [$carrito[$i]['id'],$carrito[$i]['cantidad'],$id_factura_tienda]);
        }
        */
        $request->session()->forget('cart');
        return redirect('comprafinalizada');
    }
    
    public function mostrarCompra(){
         return view('comprafinalizada');
     } 
    public function mostrarProductoCrud(){
        //$listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_foto on tbl_foto.id_f=tbl_articulo_tienda.id_foto_fk inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk');
        $listaProducto= DB::select('select * from tbl_articulo_tienda inner join tbl_marca on tbl_marca.id_ma=tbl_articulo_tienda.id_marca_fk inner join tbl_tipo_articulo on tbl_tipo_articulo.id_ta=tbl_articulo_tienda.id_tipo_articulo_fk');
        $dbMarcas=DB::select('select * from tbl_marca;');
        $dbTipos=DB::select('select * from tbl_tipo_articulo;');
        return view('admincrud', compact('listaProducto','dbMarcas','dbTipos'));
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
            //return response()->json(array('resultado'=> 'NOK: '.$request->input('id_us')));
            return response()->json(array('resultado'=> 'OK'));
        } catch (\Throwable $th) {
            return response()->json(array('resultado'=> 'NOK: '.$th->getMessage()));
        }
    }
    
}
