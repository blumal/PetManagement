<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mapa Establecimientos</title>
    <link rel="stylesheet" href="css/styledog.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/mapa-perdidos.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/style-home.css')}}"> --}}
    <link rel="icon" href="./img/imagenesWeb/logo.png">
</head>
<body>
    <nav id="nav">
        <div class="nav_container">
            <img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo">
            <label for="menu" class="nav_label">
                <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url("/")}}" class="nav_item">Home</a>
                <a href="{{url("tienda")}}" class="nav_item">Tienda</a>
                <a href="{{url("citas")}}" class="nav_item">Clínica</a>
                <a href="{{url("contacto")}}" class="nav_item">Contacto</a>
                <a href="{{url("about")}}" class="nav_item">Sobre Nosotros</a>
                <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Perdidos</a>
                <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
                @if (Session::get('cliente_session'))
                        <a class="nav_item" href="{{url("modificarPerfil")}}">Mi Perfil</a>
                        <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Login</a>
                @endif
            </div>
        </div>
        <script src="./js/nav_mapas.js"></script>
    </nav>
    <div>
        <form action="{{url('/an_perd')}}" method="GET">
            <input type="hidden" name="_method" value="POST" id="postFiltro">
            <div class="form-outline">
                <button type="submit" ><img class="sala" src="./img/imagenesWeb/buscar.png" width="200px" height="200px"></button><br><br>
            </div>
        </form>
    </div>
    <div id="map">
        
    </div>
    
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <!-- Enlace a API para hacer la logica general de los mapas  -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

    
    <!--INICIO POSIBLE PRESCINDIBLE -->
    <!-- Esri Leaflet Geocoder 

        CREO QUE ESTOS DOS ENLACES SON PRESCINDIBLES

    <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css" />
    <script src="https://unpkg.com/esri-leaflet-geocoder"></script>

    -->
    <!--FINAL POSIBLE PRESCINDIBLE -->


    <!-- Enlace a API para hacer el geocoding NO TOCAR  -->
    <script src="https://unpkg.com/esri-leaflet"></script>

    <!-- Enlace a API para hacer el geocidng Direcciones <-> Coordanedadas  NO TOCAR -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.css">
    <script src="https://cdn.jsdelivr.net/leaflet.esri.geocoder/2.1.0/esri-leaflet-geocoder.js"></script>
    <script src="js/mapa_animales_perdidos.js"></script>
</body>
</html>