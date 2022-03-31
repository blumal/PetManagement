<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

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

    /*Âñadir al carro*/
    public function CartAdd(Request $request){
        //Se recupera el id del producto seleccionado y la variable de 
        $producto = Producto::find($request->producto_id);
        $comp = $request->session()->get('carrito');
        //se comprueba si la variable de sesion está definida
        if (isset($comp)){
            //si la variable de sesion no es null, se recupera esta misma y se guarda en una variable
            $array1 = $request->session()->get('carrito');
            //se guarda el id del producto seleccionado en un array
            $array2[] = $producto->id;
            //al ser la variable de sesion un array, y el id del producto seleccionado también esta guardado en un array, se usa arraymerge para obtener como resultado un array de sesion con los diferentes ids
            $request->session()->put('carrito',array_merge($array1,$array2));
        } else {
            //si la variable de sesion esta vacia, es decir, aun no se ha añadido ningún producto al carrito se guardará como array el id del producto
            $array1[] = $producto->id;
            $request->session()->put('carrito', $array1);
        }
        //$array3=$request->session()->get('carrito');
        //return view('carritoview', compact('array3'));
        //return $array3;
        return redirect('principal');
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
        return redirect('principal');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
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
