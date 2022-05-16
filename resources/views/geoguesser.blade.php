<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mapa Establecimientos</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('css/geoguesser.css')}}">
</head>
<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a>
            <a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a>
            <a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a>
            <a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a>
            <a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a>
            <a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a>
            <a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a>
                <a href="{{url("login")}}" method="get"><li class="cta">Login</li></form></a>
        </ul>
    </header>
    <div id="img_geo" class="img_geo">
        <h1>ANIMAL GEOGUESSER</h1>
    </div>
    <form class="jugar" action="{{url('geoguesser-game')}}" method="GET">
        <button class="btn_jugar" type="submit">JUGAR</button>
    </form>
</body>
</html>