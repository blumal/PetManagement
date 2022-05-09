<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- css Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style-contraseña.css')}}">
    {{-- form registro --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{-- icono barra del navegador --}}
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    {{-- Bibliotecas Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    {{-- validacion login --}}
    <script src="../js/valid_contraseña.js"></script>
    <title>Login</title>
</head>

<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            @if (Session::get('cliente_session'))
                <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
                <form><a href="{{url("modificarPerfil")}}" method="get"><li class="menu-item">Mi Perfil</li>
                    <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                </form>
                <form><a href="{{url("logout")}}" method="get"><li class="cta-logout">Logout</li></a></form>
            @else
                <form><a href="{{url("/")}}" method="get"><li class="menu-item">Home</li></a></form>
                <form><a href="{{url("tienda")}}" method="get"><li class="menu-item">Tienda</li></a></form>
                <form><a href="{{url("citas")}}" method="get"><li class="menu-item">Clínica</li></a></form>
                {{-- <form><a href="{{url("")}}" method="get"><li class="menu-item">Mapa</li></a></form> --}}
                <form><a href="{{url("mapa_animales_perdidos")}}" method="get"><li class="menu-item">Perdidos</li></a></form>
                <form><a href="{{url("mapa_establecimientos")}}" method="get"><li class="menu-item">Establecimientos</li></a></form>
                <form><a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a></form>
                <form><a href="{{url("about")}}" method="get"><li class="menu-item">Sobre Nosotros</li></a></form>
                <form><a href="{{url("login")}}" method="get"><li class="cta">Login</li></a></form>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div class="container">
        <div class="row justify-content-center pt-5 mt-5 m-1">
            <div class="col-md-6 col-sm-8 col-xl-5 col-lg-5 formulario">
                <form action="{{url("")}}" method="post" onsubmit="return validateContraseña();">
                    @csrf
                    <div class="form-group text-center pt-3">
                        <h1>RECUPERA MI CONTRASEÑA</h1>
                    </div>
                    <div class="form-group mx-sm-4 pt-3">
                        <input type="email" class="form-control" placeholder="Correo" name="email_us" id="email_us">
                    </div>
                    {{-- @error('email_us') --}}
                    <div class="form-group mx-sm-4 pb-1">
                        <input type="submit" class="btn btn-block ingresar" value="ENVIAR">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>