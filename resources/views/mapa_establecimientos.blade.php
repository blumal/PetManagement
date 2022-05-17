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
    <link rel="stylesheet" href="{{asset('css/mapas-establecimientos.css')}}">
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                {{-- <form><a href="{{url("entretenimiento")}}" method="get"><li class="menu-item">Entretenimiento</li></a></form> --}}
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
            @if (Session::get('cliente_session'))
                <form><a href="{{url("modificarPerfil")}}" method="get"><li class="menu-item">Mi Perfil</li>
                    <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                </form>
                <form><a href="{{url("logout")}}" method="get"><li class="cta-logout">Logout</li></a></form>
            @else
                <form><a href="{{url("login")}}" method="get"><li class="cta">Login</li></a></form>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div id="map">
        
    </div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
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
    <script src="js/mapa_establecimientos.js"></script>
</body>
</html>