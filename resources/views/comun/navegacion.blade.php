<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/comun/nav.css')}}">
    <title></title>
</head>
<body>
    @if (Session::get('id_rol_session')==2)
    <nav id="nav">
        <div class="nav_container">
            <a href="{{url("/")}}"><img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo"></a>
            <label for="menu" class="nav_label">
                <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url("tienda")}}" class="nav_item">Tienda</a>
                <a href="{{url("citas")}}" class="nav_item">Clínica</a>
                <a href="{{url("juegos")}}" class="nav_item">Juegos</a>
                <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Animales Perdidos</a>
                <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
                <a href="{{url("contacto")}}" class="nav_item">Contacto</a>
                <a href="{{url("about")}}" class="nav_item">Sobre Nosotros</a>
                @if (Session::get('cliente_session'))
                        <a class="nav_item" href="{{url("modificarPerfil")}}">¡Hola {{Session::get('nombre_session')}}!</a>
                        <input type="hidden" id="id_us" value="{{Session::get('id_user_session')}}"></a>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Inicia sesión</a>
                @endif
            </div>
        </div>
    <script src="/js/home.js"></script>
    </nav>
    @elseif(Session::get('id_rol_session')==3)
    <nav id="nav">
        <div class="nav_container">
            <a href="{{url("/")}}"><img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo"></a>
            <label for="menu" class="nav_label">
                <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url("adminPacientes")}}" class="nav_item">Pacientes</a>
                <a href="{{url("homeempleado")}}" class="nav_item">Admin Citas</a>
                <a href="{{url("directorioGenerarFactura")}}" class="nav_item">Admin Visitas</a>
                <a href="{{url("chat")}}" class="nav_item">Chat</a>
                <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Animales Perdidos</a>
                <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
                @if (Session::get('id_user_session'))
                    <a class="nav_item" href="{{url("modificarPerfil")}}">¡Hola {{Session::get('nombre_session')}}!</a>
                    <input type="hidden" id="id_us" value="{{Session::get('id_user_session')}}"></a>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Inicia sesión</a>
                @endif
            </div>
        </div>
    <script src="/js/home.js"></script>
    </nav>
    @elseif(Session::get('id_rol_session')==1)
    <nav id="nav">
        <div class="nav_container">
            <a href="{{url("/")}}"><img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo"></a>
            <label for="menu" class="nav_label">
                <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
            </label>
            <input type="checkbox" id="menu" class="nav_input">
            <!--Menu header-->
            <div class="nav_menu">
                <a href="{{url("stats")}}" class="nav_item">Estadisticas</a>
                <a href="{{url("FacturasClinica")}}" class="nav_item">Facturas Visita</a>
                <a href="{{url("FacturasTienda")}}" class="nav_item">Facturas Tienda</a>
                @if (Session::get('id_user_session')) 
                        <a class="nav_item" href="{{url("modificarPerfil")}}">¡Hola {{Session::get('nombre_session')}}!</a>
                        <input type="hidden" id="id_us" value="{{Session::get('id_user_session')}}"></a>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Inicia sesión</a>
                @endif
            </div>
        </div>
    <script src="./js/home.js"></script>
    </nav>
    @elseif(!Session::get('id_rol_session'))
        <nav id="nav">
            <div class="nav_container">
                <a href="{{url("/")}}"><img src="{{url("img/visitas/Logo.png")}}" alt="" class="nav_logo"></a>
                <label for="menu" class="nav_label">
                    <img src="{{url("img/visitas/menu (4).png")}}" alt="" class="nav_img">
                </label>
                <input type="checkbox" id="menu" class="nav_input">
                <!--Menu header-->
                <div class="nav_menu">
                    <a href="{{url("tienda")}}" class="nav_item">Tienda</a>
                    <a href="{{url("citas")}}" class="nav_item">Clínica</a>
                    <a href="{{url("juegos")}}" class="nav_item">Juegos</a>
                    <a href="{{url("contacto")}}" class="nav_item">Contacto</a>
                    <a href="{{url("about")}}" class="nav_item">Sobre Nosotros</a>
                    <a href="{{url("mapa_animales_perdidos")}}" class="nav_item">Animales Perdidos</a>
                    <a href="{{url("mapa_establecimientos")}}" class="nav_item">Establecimientos</a>
                    @if (Session::get('cliente_session'))
                            <a class="nav_item" href="{{url("modificarPerfil")}}">Mi Perfil</a>
                            <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                        <a href="{{url("logout")}}" class="login_item">Logout</a>
                    @else
                        <a href="{{url("login")}}" class="login_item">Inicia sesión</a>
                    @endif
                </div>
            </div>
        <script src="./js/home.js"></script>
        </nav>
    @endif
</body>
</html>