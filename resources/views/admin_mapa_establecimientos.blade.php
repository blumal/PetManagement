<!--Método comprobación de sesión-->
@if (!Session::get('email_session'))
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
    <title>Admin Mapa Establecimientos</title>
    <link rel="stylesheet" href="css/styleadminmapaestbl.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
</head>
<body>
    {{-- Boton para volver a la vista del panel de control --}}
    <a href="">Back</a>
    @if($errors->any())
    <div>
        <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        </ul>
    </div>
    @endif
    <h1><b>Establecimientos</b></h1>
    <form action="{{url('/logout')}}" method="GET">
        <button type="submit" value="logout">LOGOUT</button><br><br>
    </form>
    <p id="mensaje"></p>
    <form id="form_crear" onsubmit="crear(); return false;" enctype="multipart/form-data">
        <input type="text" name="nombre" id="nombre" placeholder="Nombre">
        <input type="text" name="nif" id="nif" placeholder="NIF">
        <input type="email" name="email" id="email" placeholder="Email empresa">
        <input type="text" name="direccion" id="direccion" placeholder="Calle">
        <input type="number" name="num" id="num" placeholder="N Calle">
        <input type="number" name="cp" id="cp" placeholder="CP">
        <input type="number" name="telf" id="telf" placeholder="Teléfono 1">
        <input type="number" name="telf2" id="telf2" placeholder="Teléfono 2">
        <span>Horario de apertura</span>
        <input type="time" name="horario_aper" id="horario_aper" placeholder="Horario apertura">
        <span>Horario de cierre</span>
        <input type="time"  name="horario_cierre" id="horario_cierre" placeholder="Horario cierre">
        <input type="text" name="url_web" id="url_web" placeholder="Web(url)">
        <span>Foto</span>
        <input type="file" name="foto" id="foto">
        <span>Foto icono</span>
        <input type="file" name="foto_icono" id="foto_icono">
        <span>Tipo sociedad</span>
        <select name="tipo" name="tipo" id="tipo">
            <option value="null">---</option>
            <option value="clinica">Clínica</option>
            <option value="protectora">Protectora de animales</option>
        </select>
        <span>Operatividad</span>
        <select name="operativo" name="operativo" id="operativo">
            <option value="null">---</option>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <input type="submit" value="Crear">
    </form>
    <br>
    <input type="search" onkeyup="leerJS()" id="filtro" placeholder="Filtrar por nombre">
    {{-- Div donde pondremos el contenido de la recarga del ajax --}}
    <table id="tabla">

    </table>
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span id="cerrar" class="close">&times;</span>
          <div id="contenido">

          </div>
        </div>
      </div>
    {{-- Link con el ajax --}}
    <script src="js/admin_mapa_establecimientos_ajax.js"></script>
</body>
</html>