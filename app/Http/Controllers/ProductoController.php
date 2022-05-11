<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $productos=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.foto_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk, tbl_articulo_tienda.tipo_categoria_art FROM `tbl_articulo_tienda`;");
        return response()->json($productos);
    }

    public function getProduct(Request $request) {
        $datos = $request->except('_token');
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma, tbl_articulo_tienda.tipo_categoria_art, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$datos['id']]);
        $categorias=DB::select("SELECT tbl_categoria_articulo.id_cat, tbl_categoria_articulo.texto_cat, tbl_categoria_articulo.precio_cat, tbl_categoria_articulo.articulo_fk FROM `tbl_categoria_articulo` WHERE articulo_fk=? ORDER BY precio_cat ASC",[$datos['id']]);
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
           //NUEVO
           $array=array();
           foreach ($datos['palabras'] as $palabra) {
               $palabraql="SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_articulo_tienda.codigobarras_art, tbl_articulo_tienda.id_marca_fk, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_tipo_articulo ON tbl_articulo_tienda.id_tipo_articulo_fk=tbl_tipo_articulo.id_ta WHERE (tbl_tipo_articulo.tipo_articulo_ta LIKE '%".$palabra."%' OR tbl_articulo_tienda.nombre_art LIKE '%".$palabra."%') ORDER BY tbl_articulo_tienda.precio_art ".$datos['orden'];
               $Arraypalabra=DB::select($palabraql);
               array_push($array,$Arraypalabra);
           }
           $arrayLenght=count($array);
           $iguales=array();
           $result=array();
          for ($i=1; $i < $arrayLenght; $i++) { 
              if ($i==1) {
                $result=array_intersect($array[$i-1], $array[$i]);
                array_push($iguales,$result);
              }else {
                $result=array_intersect($iguales, $array[$i]);
                array_push($iguales,$result);
              }
          }
          return response()->json($iguales);
           //FIN NUEVO
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
        $producto=DB::select("SELECT tbl_articulo_tienda.id_art, tbl_articulo_tienda.nombre_art,tbl_articulo_tienda.foto_art, tbl_articulo_tienda.descripcion_art, tbl_articulo_tienda.precio_art, tbl_marca.marca_ma, tbl_articulo_tienda.tipo_categoria_art, tbl_articulo_tienda.id_tipo_articulo_fk FROM `tbl_articulo_tienda` INNER JOIN tbl_marca ON tbl_articulo_tienda.id_marca_fk=tbl_marca.id_ma WHERE tbl_articulo_tienda.id_art=?",[$id]);
        $fotos=DB::select("SELECT tbl_foto.foto_f FROM `tbl_foto` WHERE tbl_foto.articulo_tienda_fk=?",[$id]);
        $categorias=DB::select("SELECT tbl_categoria_articulo.id_cat, tbl_categoria_articulo.texto_cat, tbl_categoria_articulo.precio_cat, tbl_categoria_articulo.articulo_fk FROM `tbl_categoria_articulo` WHERE articulo_fk=? ORDER BY precio_cat ASC",[$id]);
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
        $opiniones=DB::select("SELECT tbl_opinion_articulo.id_op, tbl_opinion_articulo.texto_op, tbl_opinion_articulo.valoracion_op, tbl_usuario.nombre_us, tbl_usuario.apellido1_us, tbl_articulo_tienda.nombre_art FROM tbl_articulo_tienda INNER JOIN tbl_opinion_articulo ON tbl_articulo_tienda.id_art=tbl_opinion_articulo.articulo_fk INNER JOIN tbl_usuario ON tbl_opinion_articulo.usuario_fk=tbl_usuario.id_us WHERE tbl_articulo_tienda.id_art=?",[$datos['id']]);
        return response()->json($opiniones);
    }
    public function productosOpinionesTodas(Request $request) {
        $datos = $request->except('_token');
        $opiniones=DB::select("SELECT tbl_opinion_articulo.id_op, tbl_opinion_articulo.texto_op, tbl_opinion_articulo.valoracion_op, tbl_usuario.nombre_us, tbl_usuario.apellido1_us, tbl_articulo_tienda.nombre_art FROM tbl_articulo_tienda INNER JOIN tbl_opinion_articulo ON tbl_articulo_tienda.id_art=tbl_opinion_articulo.articulo_fk INNER JOIN tbl_usuario ON tbl_opinion_articulo.usuario_fk=tbl_usuario.id_us WHERE tbl_articulo_tienda.id_art=?",[$datos['id']]);
        return response()->json($opiniones);
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
        $request->session()->forget('cart');
        return redirect('comprafinalizada');
    }
    public function mostrarCompra(){
        return view('comprafinalizada');
    } 

    
}
