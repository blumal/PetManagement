<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/loginRegisterContacto.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>LOGIN</title>
    <link rel="icon" href="./img/imagenesWeb/logo.png">

    <title>Login</title>
</head>

<body>
    <header id="Header">
        <img src="./img/imagenesWeb/logo.png" alt="" class="logo">
        <!--Menu header-->
        <ul class="main-menu">
            <li class="menu-item">Home</li>
            <li class="menu-item" href="./views/tienda.blade.php?">Tienda</li>
            <li class="menu-item">Clínica</li>
            <li class="menu-item">Contacto</li>
            <li class="menu-item">Sobre Nosotros</li>
            <li class="cta">Login</li>
        </ul>
    </header>
    <div class="container">
        <div class="row justify-content-center pt-8 mt-5 m-2">
            <div class="col-md-6 col-sm-8 col-xl-10 col-lg-5 formulario">
                <form action="" method="post">
                    @csrf
                    <div class="form-group text-center pt-3">
                        <h1 class="text-light">Si tienes dudas no dudes en escribirnos!</h1>
                    </div>
                    <div class="form-group mx-sm-4 pb-2">
                        <input type="text" class="form-control" placeholder="Nombre" name="nombre">
                    </div>
                    <div class="form-group mx-sm-4 pb-2">
                        <input type="password" class="form-control" placeholder="Apellido" name="Apellido">
                    </div>
                    <div class="form-group mx-sm-4 pb-2">
                        <input type="password" class="form-control" placeholder="Correo" name="Correo">
                    </div>
                    <div class="form-group mx-sm-4 pb-2">
                        {{-- <input type="text" class="form-control" placeholder="Mensaje" name="Mensaje"> --}}<textarea class="form-control" placeholder="Mensaje" name="Mensaje" id="Mensaje" cols="30" rows="5.5"></textarea>
                    </div>
                    <div class="form-group mx-sm-4 pb-4">
                        <input type="submit" class="btn btn-block ingresar" value="ENVIAR">
                    </div>
                    <a href="{{url("contacto")}}" method="get"><li class="menu-item">Contacto</li></a>
                </form>
    {{-- <h1>Login</h1>
    <div class="login-form">
        <form action="{{url("login-proc")}}" method="post">
            @csrf
            <input type="email" placeholder="Ex: rauw@petmanagement.net" name="email_us"></br></br>
            <input type="password" name="pass_us"></br></br>
            <input type="submit">
        </form>

        <div class="row flex">
            <div class="column-60">
                <div class="slider-frame">
                    <ul>
                        <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-1.jpg" alt=""></li>
                        <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-2.jpg" alt=""></li>
                        <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-3.jpg" alt=""></li>
                        <li><img src="./img/imagenesWeb/fotosSlider/foto-slider-4.jpg" alt=""></li>
                    </ul> 
                </div>
            </div>
        </div>
    </div>--}}
            </div>
        </div>
    </div>
</body>

</html>