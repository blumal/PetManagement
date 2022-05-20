<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/style-home.css')}}">
    <meta name="csrf-token" id="token" content="{{ csrf_token() }}">
    
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    <title>Home</title>
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
        <img src="./img/imagenesWeb/home.jpg" class="foto">
    </div>
    <div class="row-c flex">
        <div class="column-2">
            <div class="twitter">
                <a class="twitter-timeline" data-lang="en" data-width="850" data-height="700" data-dnt="true" data-theme="dark" href="https://twitter.com/twitter?ref_src=twsrc%5Etfw">Tweets by Pet Management</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>
        </div>

        <div class="column-2">
            <div class="contenedor_grafico">
                <canvas id="chart_visitasxmeses"></canvas>
            </div>
        </div>
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
            <li class="footer-item">Privacidad</li>
            <li class="footer-item">Shipping</li>
            <li class="footer-item">Equipo</li>
        </ul>
        <span class="copyright">&copy;2021, Pet Management. Todos los derechos reservados.</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset('js/estadisticas/graficos.js')}}"></script>
</body>
</html>