<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- css Bootstrap --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style-login.css')}}">
    {{-- form registro --}}
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    {{-- icono barra del navegador --}}
    <link rel="icon" href="{{asset('img/imagenesWeb/logo.png')}}">
    {{-- Bibliotecas Alertify --}}
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.rtl.min.css"/>
    {{-- validacion login --}}
    <script src="{{asset('js/valid_login.js')}}"></script>
    <title>Login</title>
</head>

<body>
    @include('comun.navegacion')
    <div class="container">
        <div class="row justify-content-center pt-5 mt-5 m-1">
            <div class="col-md-6 col-sm-8 col-xl-5 col-lg-5 formulario">
                <form action="{{url("login-proc")}}" method="post" onsubmit="return validateLogin();">
                    @csrf
                    <input type="hidden" id="rul" name='rul' value="{{$id}}">
                    <div class="form-group text-center pt-3">
                        <h1>INICIAR SESIÓN</h1>
                    </div>
                    <div class="form-group mx-sm-4 pt-3">
                        <input type="email" class="form-control" placeholder="Correo" name="email_us" id="email_us">
                    </div>
                    {{-- @error('email_us') --}}
                    <div class="form-group mx-sm-4 pb-2">
                        <input type="password" class="form-control" placeholder="Contraseña" name="pass_us" id="pass_us">
                    </div>
                    {{-- @error('pass_us') --}}
                    <div class="form-group mx-sm-4 pb-1">
                        <input type="submit" class="btn btn-block ingresar" value="INICIAR SESIÓN">
                    </div>
                    <div>
                        <div class="form-group mx-sm-4 pb-2 text-left">
                        @if($errors->any())
                            <p style="color: red">{{$errors->first()}}</p>
                        @endif
                        </div>
                    </div>
                    <div class="form-group mx-sm-4 pb-2 text-left">
                        <a href="{{url("login/contraseña")}}"><span>Te has olvidado la contraseña?</a></span>
                    </div>
                    <div class="form-group mx-sm-4 text-left">
                        <span class="">Aún no estas registrado?</span>
                        <span><a href="{{url("registro")}}" class="olvide1">REGISTRARSE</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>