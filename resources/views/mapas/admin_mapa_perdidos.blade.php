<!--Método comprobación de sesión-->
@if (!Session::get('admin_session'))
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('login')->send();
    ?>
@endif
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Mapa Perdidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleadminmapaperdidos.css">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    <form class="head" action="{{url('/cpanel')}}" method="GET">
        <button type="submit" value="logout" class="btn btn-info">Back</button>
        <h1>Animales Perdidos</h1>
    </form>
    @if($errors->any())
    <div>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif
    {{-- <div>
        <form action="{{url('/logout')}}" method="GET">
            <button type="submit" value="logout" class="btn btn-danger">LOGOUT</button><br><br>
        </form>
    </div> --}}
    <div class="content_up">
        <div>
            <form class="crear" id="boton">
                <a name="Crear" value="Crear" onclick="crearJS()" id="crear" value="Crear Mascota Perdida">Crear</a>
            </form>
            <form class="filtro" method="post" onsubmit="return false;">
                {{-- <input type="hidden" name="_method" value="POST" id="postFiltro"> --}}
                <div class="form-outline">
                    <input type="search" id="filtro" name="nombre_art" class="form-control" placeholder="Filtrar por nombre" aria-label="Search" onkeyup="leerJS(); return false;"/>
                </div>
            </form>
        </div>
    </div>
    <p id="mensaje"></p>
    {{-- Div donde pondremos el contenido de la recarga del ajax --}}
    <div class="table-responsive">
        <div class="style_table">
            <table id="tabla">
            </table>
        </div>
    </div>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span id="cerrar" class="close">&times;</span>
          <div id="contenido">

          </div>
        </div>
      </div>
    {{-- Link con el ajax --}}
    <script src="./js/admin_mapa_perdidos_ajax.js"></script>
</body>
</html>