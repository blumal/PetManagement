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
    
}
