<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <script src="../public/js/ajax.js"></script>
    <script src="../public/js/code.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/stylecrud.css">
    <title>Document</title>
</head>
<body>
    <div class="crear" id="boton">
        <button class="crear_input" name="Crear" value="Crear" id="botoncrear" onclick="abrirmodal_crear(); return false;" ><b><i class="fa-solid fa-circle-plus"></i> CREAR</b></button>
    </div>
    <div>
        <form method="post" onsubmit="return false;">
            <input type="hidden" name="_method" value="POST" id="postFiltro">
            <div class="form-outline">
               <input type="search" id="search" name="nombre_art" class="form-control" placeholder="Buscar por titulo..." aria-label="Search" onkeyup="filtro(); return false;"/>
            </div>
         </form>
    </div>
    <div>
        <table class="table" id="table">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Precio</th>
                <th scope="col">Código de barras</th>
                <th scope="col">Marca</th>
                <th scope="col">Tipo de Artículo</th>
                <th scope="col" colspan="2">Acciones</th>
            </tr>
            @forelse ($listaProducto as $prod)
            <tr>
                <td scope="row">{{$prod->id_art}}</td>
                <td>{{$prod->nombre_art}}</td>
                <td>{{$prod->descripcion_art}}</td>
                <td>{{$prod->precio_art}}</td>
                <td>{{$prod->codigobarras_art}}</td>
                <td>{{$prod->marca_ma}}</td>
                <td>{{$prod->tipo_articulo_ta}}</td>
                <td>
                    {{-- Route::get('/clientes/{cliente}/edit',[ClienteController::class,'edit'])->name('clientes.edit'); --}}
                    <button class= "btn btn-secondary" type="submit" value="Edit" onclick="abrirmodal_editar({{$prod->id_art}},'{{$prod->nombre_art}}','{{$prod->descripcion_art}}','{{$prod->precio_art}}','{{$prod->codigobarras_art}}','{{$prod->id_ma}}','{{$prod->id_tipo_articulo_fk}}');return false;">Editar</button>
                </td>
                <td>
                    {{-- Route::delete('/clientes/{cliente}',[ClienteController::class,'destroy'])->name('clientes.destroy'); --}}
                    <form method="post">
                        <input type="hidden" name="_method" value="DELETE" id="deleteNotee">
                        <button class="btn btn-danger" type="submit" value="Delete" onclick="eliminar({{$prod->id_art}}); return false;">Eliminar</button>
                     </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">No hay registros</td></tr>
            @endforelse
        </table>
    </div>
    <div class="modalbox_editar" id="modalbox_editar">
        <div class="modaleditar" id="modaleditar">
            <span class="close" onclick="closeModal_editar(); return false;">&times;</span>             
            <h2><b>EDITAR PRODUCTO</b></h2>
            <form id="formUpdate" method="post" onsubmit="actualizar();closeModal_editar();return false;" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PUT" id="modifNote">
                <input class="inputcrear" type="text" name="nombre_art_e" id="nombre_art_e" placeholder="Nombre">
                <input class="inputcrear" type="text" name="descripcion_art_e" id="descripcion_art_e" placeholder="Descripcion">
                <input class="inputcrear" type="text" name="precio_art_e" id="precio_art_e" placeholder="Precio">
                <input class="inputcrear" type="text" name="codigobarras_art_e" id="codigobarras_art_e" placeholder="Codigo de barras">
                <input class="inputcrear" type="file" name="foto_e" id="foto_e" placeholder="Foto">
                <h4>Marca</h4>
                <select class="inputcrear" name="id_marca_fk_e" id="id_marca_fk_e">
                    <option></option>
                     @foreach ($dbMarcas as $item)
                        <option value="{{$item->id_ma}}">{{$item->marca_ma}}</option>
                    @endforeach
                </select>
                <h4>Tipo</h4>
                <select class="inputcrear" name="id_tipo_articulo_fk_e" id="id_tipo_articulo_fk_e">
                    <option></option>
                     @foreach ($dbTipos as $item2)
                        <option value="{{$item2->id_ta}}">{{$item2->tipo_articulo_ta}}</option>
                    @endforeach
                </select>
                <button class="botoncrear" type="submit" value="Editar"><b>EDITAR</b></button>
                <input type="hidden" name="id_art_e" id="idUpdate">
            </form>
        </div>
    </div>
    <div class="modalbox_crear" id="modalbox_crear">
        <div class="modalcrear_header">
            <span class="close_crear" onclick="closeModal_crear(); return false;">&times;</span>             
            <h2 class="titulomodal">Crear <b>Producto</b></h2>
        </div>
        <div class="modalcrear" id="modalcrear">
            <form onsubmit="crear();closeModal_crear();return false;" method="post" id="formcrear" enctype="multipart/form-data">
                <input class="inputcrear" type="text" name="nombre_art" id="nombre_art" placeholder="Nombre" onfocus="error_registro1()" onkeyup="error_validar1()">
                <div id="mensaje1">
                </div>
                <input class="inputcrear" type="text" name="descripcion_art" id="descripcion_art" placeholder="Descripcion" onfocus="error_registro2()" onkeyup="error_validar2()">
                <div id="mensaje2">
                </div>
                <input class="inputcrear" type="number" name="precio_art" id="precio_art" placeholder="Precio" onfocus="error_registro3()" onkeyup="error_validar3()">
                <div id="mensaje3">
                </div>
                <input class="inputcrear" type="text" name="codigobarras_art" id="codigobarras_art" placeholder="Codigo de barras" onfocus="error_registro4()" onkeyup="error_validar4()">
                <div id="mensaje4">
                </div>
                <input class="inputcrear" type="file" name="foto" id="foto" placeholder="Foto">
                <h4>Marca</h4>
                <select class="inputcrear" name="id_marca_fk" id="id_marca_fk">
                    <option value=""></option>
                     @foreach ($dbMarcas as $item)
                        <option value="{{$item->id_ma}}">{{$item->marca_ma}}</option>
                    @endforeach
                </select>
                <h4>Tipo</h4>
                <select class="inputcrear" name="id_tipo_articulo_fk" id="id_tipo_articulo_fk">
                    <option value=""></option>
                     @foreach ($dbTipos as $item2)
                        <option value="{{$item2->id_ta}}">{{$item2->tipo_articulo_ta}}</option>
                    @endforeach
                </select>
                <div id="mensaje">
                <button class="botoncrear" type="submit" value="Crear"><b>CREAR</b></button>
                <input type="hidden" name="_method" value="POST" id="createNote">
            </form>
        </div>
    </div>
    <div id="message" style="color:green"></div>
</body>
</html>