<!--Método comprobación de sesión-->
@if (!Session::get('cliente_session'))
    <?php
        //Si la session no esta definida te redirige al login, la session se crea en el método.
        return redirect()->to('login')->send();
    ?>
@endif
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
    <link rel="stylesheet" href="{{asset('css/style-perfil.css')}}">
    {{-- icono barra del navegador --}}
    <link rel="icon" href="./img/imagenesWeb/logo.png">
    {{-- Bibliotecas validacion Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    {{-- validacion perfil --}}
    <script src="./js/login_registro/valid_perfil.js"></script>
    <title>Perfil</title>
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
                    <form class="nav_item">
                        <a class="profile" href="{{url("modificarPerfil")}}">Mi Perfil</a>
                        <input type="hidden" id="id_us" value="<?php echo session('id_user_session')?>"></a>
                    </form>
                    <a href="{{url("logout")}}" class="login_item">Logout</a>
                @else
                    <a href="{{url("login")}}" class="login_item">Login</a>
                @endif
            </div>
        </div>
        <script src="./js/home.js"></script>
    </nav>
    <div class="container">
        <div class="row justify-content-center pt-2 mt-1">
            <div class="formulario">
                <form action="{{url('/modificarPerfilPost')}}" method="POST" onsubmit="return validatePerfil();">
                    @csrf
                    <div class="form-group text-center">
                        <h3 class="form-group" style="margim-top: -5px !important; margin-bottom: -10px !important;">MI PERFIL</h3>
                    </div>
                    @foreach ($profile as $perfil)
                    
                        <input type="hidden" name="id_us" value="{{$perfil->id_us}}">
                        
                        <span>Datos personales</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="nombre_us" id="nombre_us" placeholder="Nombre *" value="{{$perfil->nombre_us}}">
                            </div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="apellido_us1" id="apellido1_us" placeholder="Apellido 1 *" value="{{$perfil->apellido1_us}}">
                            </div>
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="apellido_us2" id="apellido_us2" placeholder="Apellido 2" value="{{$perfil->apellido2_us}}" autocomplete="new-password">
                            </div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="email_us" id="email_us" style="visibility: hidden;" placeholder="Correo electrónico *" value="{{$perfil->email_us}}">
                            </div>
                        </div>
                        
                        <span>Contraseñas</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control" name="old_pass" id="pass_us" placeholder="Contraseña actual" autocomplete="none">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control" name="new_pass" id="new_pass" placeholder="Nueva contraseña">
                            </div>
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control"  style="visibility: hidden;" name="pass_us_no" id="pass_us" placeholder="Nueva contraseña">
                            </div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="password" class="form-control" name="new_pass_confirm" id="new_pass_confirm" placeholder="Confirmar nueva contraseña">
                            </div>
                        </div>
                        <span>Contacto</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="contacto1_tel" id="contacto1_tel" placeholder="Teléfono *" value="{{$perfil->contacto1_tel}}">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="contacto2_tel" id="contacto2_tel" placeholder="Teléfono 2" value="{{$perfil->contacto2_tel}}">
                            </div>
                        </div>
                        <span>Ubicación</span>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="nombre_di" id="nombre_di" placeholder="Dirección *" value="{{$perfil->nombre_di}}">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="cp_di" id="cp_di" placeholder="Código postal *" value="{{$perfil->cp_di}}">
                            </div>
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="numero_di" id="numero_di" placeholder="Número *" value="{{$perfil->numero_di}}">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="bloque_di" id="bloque_di" placeholder="Bloque" value="{{$perfil->bloque_di}}">
                            </div>
                        </div>
                        <div>
                            <div class="form-group-1 mx-sm-2">
                                <input type="number" class="form-control" name="piso_di" id="piso_di" placeholder="Piso" value="{{$perfil->piso_di}}">
                            </div>
                            
                            <div class="form-group-1 mx-sm-2">
                                <input type="text" class="form-control" name="puerta_di" id="puerta_di" placeholder="Puerta" value="{{$perfil->puerta_di}}">
                            </div>
                        </div>
                        
                    <div class="form-group mx-sm-3">
                        <input type="submit" class="btn btn-block ingresar" value="GUARDAR">
                    </div>
                    @endforeach
                </form>
            </div>
        </div>
    </div>
</body>
</html>