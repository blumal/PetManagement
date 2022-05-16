<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="stylesheet" href="{{asset('css/style-about.css')}}">
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="{{asset('js/estadisticas/graficos.js')}}"></script>
    


    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">

    <title>STATS</title>
    <style>
        .contenedor_grafico{
            width: 40%;
            height: 50%
        }
    </style>
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
        <script src="./js/home.js"></script>
    </header>
    <div class="column-1">
        <img src="./img/imagenesWeb/logo.png" class="foto">
    </div>

    <div>
        <div class="contenedor_grafico">
            <canvas class="contenedor_grafico" id="chart_pedidosxmes"></canvas>
        </div>
    
        <div class="contenedor_grafico">
            <canvas id="chart_visitasxhoras"></canvas>
        </div>
    </div>
    
    <div>
        <div class="contenedor_grafico">
            <canvas id="chart_visitasxmeses"></canvas>
        </div>
    
        <div class="contenedor_grafico">
            <canvas id="chart_pacientesxnombre"></canvas>
        </div>
    </div>
    

    <div class="contenedor_grafico">
        <canvas id="chart_sociedadesxtipo"></canvas>
    </div>

    


    <footer>
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <div class="social-icons-container">
            <a href="https://www.twitter.com/petmanagement" class="social-icon"></a>
            <a href="https://www.t.me/petmanagement" class="social-icon"></a>
        </div>
        <ul class="footer-menu-container">
            <li class="footer-item">Legal</li>
            <li class="footer-item">Cookies</li>
            <li class="footer-item">Privacy</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Refunds</li>
        </ul>
        <span class="copyright">&copy;2021, Krey Academy. All rights reserved.</span>
    </footer>
</body>
</html>