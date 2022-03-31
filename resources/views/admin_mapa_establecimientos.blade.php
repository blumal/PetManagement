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
    <a href="">Log Out</a>
    <p id="mensaje"></p>
    <form onsubmit="crear(); return false;">
        <input type="text" id="nombre" placeholder="Nombre">
        <input type="text" id="direccion" placeholder="Dirección">
        <input type="number" id="telf" placeholder="Teléfono">
        <span>Horario de apertura</span>
        <input type="time" id="horario_aper" placeholder="Horario apertura">
        <span>Horario de cierre</span>
        <input type="time" id="horario_cierre" placeholder="Horario cierre">
        <input type="text" id="url_web" placeholder="Web(url)">
        <input type="file" id="foto" placeholder="Foto">
        <select name="tipo" id="tipo">
            <option value="clinica">Clínica</option>
            <option value="protectora">Protectora de animales</option>
        </select>
        <input type="submit" value="Crear">
    </form>
    <br>
    <input type="search" onkeyup="leerJS()" id="filtro" placeholder="Filtrar por nombre">
    {{-- Div donde pondremos el contenido de la recarga del ajax --}}
    <table id="contenido">

    </table>
    {{-- Modal --}}
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <span id="cerrar" class="close">&times;</span>
          <p id="contenido"></p>
        </div>
      </div>
    {{-- Link con el ajax --}}
    <script src="js/admin_mapa_establecimientos_ajax.js"></script>
</body>
</html>