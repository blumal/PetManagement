<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/loginRegisterContacto.css">
    <title>LOGIN</title>
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
    <div class="container">
        <div class="row justify-content-center pt-3 mt-1 m-1">
            <div class="col-md-6 col-sm-8 col-xl-5 col-lg-5 formulario">
                <form action="">
                    <div class="form-group text-center">
                        <h1 class="text-light">REGISTRARSE</h1>
                    </div>
                    <div class="form-group mx-sm-2 pt-2">
                        <input type="text" class="form-control" placeholder="Escribe tu Nombre">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu Apellido">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu Contraseña">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu Contraseña">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu Correo">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu DNI">
                    </div>
                    <div class="form-group mx-sm-2 pb-1">
                        <input type="text" class="form-control" placeholder="Escribe tu Número de teléfono">
                    </div>
                    <div class="form-group mx-sm-3 pb-2">
                        <input type="submit" class="btn btn-block ingresar" value="REGISTRARME">
                    </div>
                    <div class="form-group mx-sm-4 text-left">
                        <span class="">Ya tienes una cuenta?</span>
                        <span><a href="login.blade.php" class="olvide1">Iniciar sesión</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>