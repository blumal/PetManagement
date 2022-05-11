<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- form registro --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{-- css Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style-register.css')}}">
    {{-- icono barra del navegador --}}
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    {{-- Bibliotecas validacion Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    {{-- validacion registro --}}
    <script src="./js/valid_registro.js"></script>
    <title>Registro</title>
</head>

<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public" method="get"><li class="menu-item">Home</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/tienda" method="get"><li class="menu-item">Tienda</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/citas" method="get"><li class="menu-item">Clínica</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/contacto" method="get"><li class="menu-item">Contacto</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/about" method="get"><li class="menu-item">Sobre Nosotros</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/mapa_animales_perdidos" method="get"><li class="menu-item">Perdidos</li></a>
            <a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/mapa_establecimientos" method="get"><li class="menu-item">Establecimientos</li></a>
            @if (Session::get('email_session'))
                <a href="{{url("logout")}}" method="get"><li class="cta">Logout</li></form></a>
            @else
                <a href="{{url("login")}}" method="get"><li class="cta">Login</li></form></a>
            @endif
        </ul>
        <script src="./js/home.js"></script>
    </header>
    <div class="container">
        <div class="row justify-content-center pt-2 mt-1">
            <div class="formulario">
                {{-- <div class="formIzquierda"> --}}
                    <form action="{{url('')}}" method="POST" onsubmit="return validateRegistro();">
                        <div class="form-group text-center">
                            <h3 class="form-group" style="margim-top: -5px !important; margin-bottom: -10px !important;">REGISTRARSE</h3>
                        </div>
                        <span>Datos personales</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="nombre_us" id="nombre_us" placeholder="Nombre *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="dni_us" id="dni_us" placeholder="Dni *">
                            </div>
                            
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="apellido1_us" id="apellido1_us" placeholder="Primer apellido *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="apellido2_us" id="apellido2_us" placeholder="Segundo apellido *">
                            </div>
                            
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control" name="pass_us" id="pass_us" placeholder="Contraseña *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control" name="pass_us" id="pass_us" placeholder="Confirmar Contraseña *">
                            </div>
                            
                        </div>
                        <span>Contacto</span>
                        <div class="form-group-2 mx-sm-2">
                            <input type="text" class="form-control" name="email_us" id="email_us" placeholder="Correo electrónico *">
                        </div>
                        
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="contacto1_tel" id="contacto1_tel" placeholder="Teléfono *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="contacto2_tel" id="contacto2_tel" placeholder="Teléfono 2 (opcional)">
                            </div>
                            
                        </div>
                        <span>Ubicación</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="nombre_di" id="nombre_di" placeholder="Dirección *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="cp_di" id="cp_di" placeholder="Código postal *">
                            </div>
                            
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="numero_di" id="numero_di" placeholder="Número *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="bloque_di" id="bloque_di" placeholder="Bloque (Si tiene más)">
                            </div>
                            
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="piso_di" id="piso_di" placeholder="Piso *">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="puerta_di" id="puerta_di" placeholder="Puerta *">
                            </div>
                            
                        </div>
                        <div class="form-group mx-sm-3">
                            <input type="submit" class="btn btn-block ingresar" value="REGISTRARME">
                        </div>
                        <div class="form-group mx-sm-3 text-left">
                            <span class="">Ya tienes una cuenta?</span>
                            <span><a href="http://localhost/www/DAW/PROYECTOS/Proyecto-5/PetManagement/public/login" class="olvide1">Iniciar sesión</a></span>
                        </div>
                    </form>
                {{-- </div>
                <div class="formDerecha">
                    <img src="./img/imagenesWeb/5375857.png" alt="" height="100%" width="100%">
                </div> --}}
            </div>
        </div>
    </div>
</body>
</html>